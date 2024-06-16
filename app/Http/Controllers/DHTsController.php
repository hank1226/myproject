<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Device;
use App\Models\User;
use App\Models\DHT;
use DB;
use Illuminate\Support\Facades\Auth;

class DHTsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dhts = DHT::orderby('created_at', 'desc')->paginate(10);
        
        $user_id = auth()->user()->id;
        $dht = DB::table('dht')
            ->join('devices', 'dht.fk_id', '=', 'devices.id')
            ->join('users', 'devices.fk_id', '=', 'users.id')
            ->where('users.id', '=', $user_id)
            ->select('dht.*')
            ->distinct()
            ->get();

        $devices = DB::table('devices')
            ->join('dht', 'dht.fk_id', '=', 'devices.id')
            ->select('devices.id', 'devices.name')
            ->get();

        return view('dhts.index')->with(['dhts' => $dhts, 'dht' => $dht, 'devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $devices = DB::table('devices')->select('id', 'name')
            ->where('fk_id', '=', $user_id)
            ->get();

        return view('dhts.create')->with('devices', $devices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dht_sn' => 'required|unique:dht,dht_sn',
            'fk_id' => 'required',
            // 'dht_name' => ['required', 'unique:devices'],
            // 'pzem_name' => ['required', 'unique:devices'],
            // 'cover_image' => 'image|nullable|max:1999',
        ]);
        // $validator->setCustomMessages([
        //     'unique' => 'The :attribute must be unique in the table.',
        // ]);
        

        $dht = new DHT;
        $dht->dht_sn = $request->input('dht_sn');
        $dht->fk_id = $request->input('fk_id');
        $dht->save();
        return redirect('/dhts')->with('success', 'DHT Created!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dhts = DHT::find($id);
        $user_id = auth()->user()->id;
        $devices = DB::table('devices')->select('id', 'name')
            ->where('fk_id', '=', $user_id)
            ->get();

        return view('dhts.show')->with(['dhts' => $dhts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dht = DHT::find($id);
        $user_id = auth()->user()->id;
        $device = DB::table('devices')->select('id', 'name')
            ->where('fk_id', '=', $user_id)
            ->get();

        $user = DB::table('users')
            ->join('devices', 'users.id', '=', 'devices.fk_id')
            ->join('dht', 'devices.id', '=', 'dht.fk_id')
            ->where('dht.id', '=', $id)
            ->select('users.id as id')
            ->distinct()
            ->get();
        
        if(auth()->user()->id !==$user[0]->id)
        {
            return redirect('/dhts')->with('error', 'Unauthorized Page!');
        }

        return view('dhts.edit')->with(['dht' => $dht,  'devices' => $device]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dht_sn' => ['required', 'unique:dht,dht_sn,'.$id],
            'fk_id' => 'required',
            // 'dht_name' => ['required', 'unique:devices'],
            // 'pzem_name' => ['required', 'unique:devices'],
            // 'cover_image' => 'image|nullable|max:1999',
        ]);

        $dht = DHT::find($id);
        $dht->dht_sn = $request->input('dht_sn');
        $dht->fk_id = $request->input('fk_id');
        $dht->save();
        return redirect('/dhts')->with('success', 'DHT Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dht = DHT::find($id);
        $dht->delete();
        return redirect('/dhts')->with('success', 'DHT Deleted!');
    }
}
