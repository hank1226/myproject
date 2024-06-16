<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Device;
use App\Models\User;
use App\Models\DHT;
use App\Models\PZEM;
use App\Models\PZEMrecord;
use App\Models\DHTrecord;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $devices = Device::orderby('created_at', 'desc')->paginate(10);
        return view('devices.index')->with('devices', $devices);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('devices.create');
        
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
            'name' => 'required',
            'note' => 'nullable',
        ]);

        $device = new Device;
        $device->name = $request->input('name');
        $device->note = $request->input('note');
        $fk_id = auth()->user()->id;
        $user = User::find($fk_id);
        $device->fk_id = $user->id;
        $device->save();

        return redirect('/devices')->with('success', 'Device created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $device = Device::find($id);
        // get dhtrecords
        $dhts = DHT::where('fk_id', '=', $device->id)
            ->select('id', 'dht_sn')
            ->get();   
        if(!$dhts->isEmpty()){
            $dhtrecords = DHTrecord::whereBelongsTo($dhts)
            ->select('fk_id', 'temperature', 'humidity_rate', 'record_time')
            ->whereIn('record_time', function($query){
                $query->selectRaw('MAX(record_time)')
                ->from('dhtrecords')
                ->whereColumn('fk_id', 'dhtrecords.fk_id')
                ->groupBy('fk_id');
            })
            ->get();
        }else{
            $dhtrecords = collect();
        }
        
        // get pzemrecords
        $pzems = PZEM::where('fk_id', '=', $device->id)
            ->select('id', 'pzem_sn')
            ->get();
        if(!$pzems->isEmpty()){
            $pzemrecords = PZEMrecord::whereBelongsTo($pzems)
            ->select('fk_id', 'Voltage', 'Current', 'Power', 'Energy', 'PF', 'Frequency', 'record_time')
            ->whereIn('record_time', function ($query) {
                $query->selectRaw('MAX(record_time)')
                    ->from('pzemrecords')
                    ->whereColumn('fk_id', 'pzemrecords.fk_id')
                    ->groupBy('fk_id');
            })
            ->get();
        }else{
            $pzemrecords = collect();
        }     

        return view('devices.show',['device'=> $device, 'dhts' => $dhts, 'pzems' => $pzems, 'dhtrecords' => $dhtrecords, 'pzemrecords' => $pzemrecords]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $device = Device::find($id);

        if(auth()->user()->id !==$device->fk_id)
        {
            return redirect('/devices')->with('error', 'Unauthorized Page!');
        }

        return view('/devices.edit')->with('device', $device);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate($request, [
            'name' => 'required',
            'note' => 'nullable',
        ]);
    
        $device = Device::find($id);
        $device->name = $request->input('name');
        $device->note = $request->input('note');
        $device->save();
    
        return redirect('/devices')->with('success', 'Device Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $device = Device::find($id);
        $device->delete();

        return redirect('/devices')->with('success', 'Device Deleted!');
    }
}
