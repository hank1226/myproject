<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Device;
use App\Models\User;
use App\Models\PZEM;
use DB;
use Illuminate\Support\Facades\Auth;

class PZEMsController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pzems = PZEM::orderby('created_at', 'desc')->paginate(10);
        $user_id = auth()->user()->id;
        $pzem = DB::table('pzem')
            ->join('devices', 'pzem.fk_id', '=', 'devices.id')
            ->join('users', 'devices.fk_id', '=', 'users.id')
            ->where('users.id', '=', $user_id)
            ->select('pzem.*')
            ->distinct()
            ->get();

        $devices = DB::table('devices')
            ->join('pzem', 'pzem.fk_id', '=', 'devices.id')
            ->select('devices.id', 'devices.name')
            ->get();

        return view('pzems.index',['pzems' => $pzems, 'pzem' => $pzem, 'devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user_id = auth()->user()->id;
        $devices = DB::table('devices')->select('id', 'name')
            ->where('fk_id', '=', $user_id)
            ->get();
        return view('pzems.create')->with('devices', $devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'pzem_sn' => 'required|unique:pzem,pzem_sn',
            'fk_id' => 'required',
        ]);
        $pzem = new PZEM;
        $pzem->pzem_sn = $request->input('pzem_sn');
        $pzem->fk_id = $request->input('fk_id');
        $pzem->save();
        return redirect('/pzems')->with('success', 'PZEM Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pzem = PZEM::find($id);
        return view('pzems.show')->with('pzem', $pzem);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pzem = PZEM::find($id);
        $user_id = auth()->user()->id;
        $devices = DB::table('devices')->select('id', 'name')
            ->where('fk_id', '=', $user_id)
            ->get();
           
        $user = DB::table('users')
        ->join('devices', 'users.id', '=', 'devices.fk_id')
        ->join('pzem', 'devices.id', '=', 'pzem.fk_id')
        ->where('pzem.id', '=', $id)
        ->select('users.id as id')
        ->distinct()
        ->get();
        
        if(auth()->user()->id !==$user[0]->id)
        {
            return redirect('/pzems')->with('error', 'Unauthorized Page!');
        }
        return view('pzems.edit')->with(['pzem' => $pzem, 'devices' => $devices]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'pzem_sn' => 'required',
            'fk_id' => 'required',
        ]);

        $pzem = PZEM::find($id);
        $pzem->pzem_sn = $request->input('pzem_sn');
        $pzem->fk_id = $request->input('fk_id');
        $pzem->save();

        return redirect('/pzems')->with('success', 'PZEM Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $pzem = PZEM::find($id);
        $pzem->delete();
        return redirect('/pzems')->with('success', 'PZEM Deleted!');
    }
}
