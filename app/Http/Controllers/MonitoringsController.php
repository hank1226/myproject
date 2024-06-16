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



class MonitoringsController extends Controller
{
    // dht, pzem ajax
    public function sensors()
    {
        $devices = Device::select('id')->get();
       
        $dhts = DHT::select('id', 'fk_id', 'dht_sn')->get();
        $pzems = PZEM::select('id', 'pzem_sn', 'fk_id')->get();

        $dhtrecords = DHTrecord::whereBelongsTo($dhts)
            ->select('id', 'fk_id', 'temperature', 'humidity_rate', 'record_time')
            ->whereIn('record_time', function($query){
                $query->selectRaw('MAX(record_time)')
                ->from('dhtrecords')
                ->whereColumn('fk_id', 'dhtrecords.fk_id')
                ->groupBy('fk_id');
            })
            ->get();
        
        $pzemrecords = PZEMrecord::whereBelongsTo($pzems)
            ->select('id', 'fk_id', 'Voltage', 'Current', 'Power', 'Energy', 'PF', 'Frequency', 'record_time')
            ->whereIn('record_time', function ($query) {
                $query->selectRaw('MAX(record_time)')
                    ->from('pzemrecords')
                    ->whereColumn('fk_id', 'pzemrecords.fk_id')
                    ->groupBy('fk_id');
            })
            ->get();

        return [$dhtrecords, $pzemrecords];
    }

    // show dht information
    public function dhtrecords($id){
        $dht = DHT::find($id);  
        //$user_id = auth()->user()->id;
        $device = DB::table('devices')
        ->join('users', 'devices.fk_id', 'users.id')
        ->join('dht', 'devices.id', 'dht.fk_id')
        ->where('devices.id', '=', $dht->fk_id)
        ->select('devices.id')
        ->get();    
        $dhtrecords = DHTrecord::wherebelongsTo($dht)->get();
        // echo $device[0]->id;
        return view('monitorings.dhtrecords', ['dht' => $dht, 'dhtrecords' => $dhtrecords, 'device' => $device]);
    }

    // dht chart
    public function getdhtrecords(Request $request){
        $dhtid = $request->dhtid;
        $dht = DHT::find($dhtid); 
        // echo $dht;
        $endTime = now();
        if ($request->filled('timeRange')) {
            $startTime = $request->timeRange;
            // echo $startTime ."~". $endTime;
        }
        $dhtrecords = DHTrecord::whereBelongsTo($dht)
            ->whereBetween('record_time', [$startTime, $endTime])
            ->select('record_time', 'temperature', 'humidity_rate')
            ->get();
        
        return view('monitorings.getdhtrecords', ['startTime' => $startTime, 'endTime' => $endTime, 'dhtrecords' => $dhtrecords, 'dht' => $dht]);
    }

    // show pzem information
    public function pzemrecords($id){
        $pzem = PZEM::find($id);  
       // $user_id = auth()->user()->id;
        $device = DB::table('devices')
        ->join('users', 'devices.fk_id', 'users.id')
        ->join('pzem', 'devices.id', 'pzem.fk_id')
        ->where('devices.id', '=', $pzem->fk_id)
        ->select('devices.id')
        ->get();    
        $pzemrecords = PZEMrecord::wherebelongsTo($pzem)->get();
        // echo $device[0]->id;
        return view('monitorings.pzemrecords', ['pzem' => $pzem, 'pzemrecords' => $pzemrecords, 'device' => $device]);
    }

    // pzem chart
    public function getpzemrecords(Request $request){
        $pzemid = $request->pzemid; 
        $pzem = PZEM::find($pzemid);
        // echo $pzem;
        $endTime = now();
        if ($request->filled('timeRange')) {
            $startTime = $request->timeRange;
            // echo $startTime ."~". $endTime;
        }
        $pzemrecords = PZEMrecord::whereBelongsTo($pzem)
        ->whereBetween('record_time', [$startTime, $endTime])
        ->select('record_time', 'Voltage', 'Current', 'Power', 'Energy', 'PF', 'Frequency')
        ->get();

        return view('monitorings.getpzemrecords', ['startTime' => $startTime, 'endTime' => $endTime, 'pzemrecords' => $pzemrecords, 'pzem' => $pzem]);
    }
}
