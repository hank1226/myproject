@extends('layouts.app')

@section('content')
    <h1>{{$device->name}}</h1>
    <br>
        {!!$device->note!!}

    <hr>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                @if(count($dhts) > 0)
                    @foreach($dhts as $dht)
                        <div class="card">
                            <div class="card-body">
                                    <h5 class="card-title">DHT_sn : {{$dht->dht_sn}}</h5>
                                    @php 
                                        $dhtrecord = $dhtrecords->where('fk_id', $dht->id)->first();
                                    @endphp
                                    @if($dhtrecord)
                                        <p class="card-text" id="dhtrecord{{ $dhtrecord->fk_id }}-temperature">Temperature : N/A</p>
                                        <p class="card-text" id="dhtrecord{{ $dhtrecord->fk_id }}-humidity_rate">Humidity Rate : N/A</p>  
                                        <p class="card-text" style = "color:gray" id = "dhtrecord{{ $dhtrecord->fk_id }}-recordtime"></p>
                                    @else
                                        <p class="card-text">Temperature : N/A</p>
                                        <p class="card-text">Humidity_rate : N/A</p>
                                    @endif
                                <a href="{{ url("{$dht->id}/dhtrecords") }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col">
                @if(count($pzems) > 0)
                    @foreach($pzems as $pzem)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">PZEM_sn : {{$pzem->pzem_sn}}</h5>
                                @php
                                    $pzemrecord = $pzemrecords->where('fk_id', $pzem->id)->first();
                                @endphp
                                @if($pzemrecord)
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-Voltage">Voltage : N/A</p>
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-Current">Current : N/A</p>
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-Power">Power : N/A</p>
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-Energy">Energy : N/A</p>
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-PF">PF : N/A</p>
                                    <p class="card-text" id = "pzemrecord{{$pzemrecord->fk_id}}-Frequency">Frequency : N/A</p>
                                    <p class="card-text" style = "color:gray" id = "pzemrecord{{ $pzemrecord->fk_id }}-recordtime"></p>
                                @else
                                    <p class="card-text">Voltage : N/A</p>
                                    <p class="card-text">Current : N/A</p>
                                    <p class="card-text">Power : N/A</p>
                                    <p class="card-text">Energy : N/A</p>
                                    <p class="card-text">PF : N/A</p>
                                    <p class="card-text">Frequency : N/A</p>
                                @endif
                                <a href="{{ url("{$pzem->id}/pzemrecords") }}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div>
        <a href="{{url ('/devices')}}" class = "btn btn-primary">Go Back</a>
    </div>

    <style>
        .card {
            background: rgba(255, 255, 255, 0.2);
            color: #162938;
            outline: none;
            border: none;
            border-radius: 20px;
            margin-bottom: 10px;
        }

       h1 {
        margin-top: 100px;
       }
    </style>
@extends('layouts.ajax-display')
@endsection
