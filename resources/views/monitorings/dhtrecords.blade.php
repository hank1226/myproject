@extends('layouts.app')

@section('content')
    <h1>Search Historical Records</h1>
    {!! Form::open(['action' => 'App\Http\Controllers\MonitoringsController@getdhtrecords', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="card">
        <div class="card-header">
            DHT_sn : {{$dht->dht_sn}}
        </div>
        <div class="card-body">
            <form>
                <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Time Option : </legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="timeRange" id="day" value="{{date('Y-m-d H:i:s',(time()-24*3600))}}" checked>
                        <label class="form-check-label" for="gridRadios1">Recent 24hr</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="week" type="radio" name="timeRange" value="{{date('Y-m-d H:i:s',(time()-7*24*3600))}}">
                        <label class="form-check-label" for="gridRadios2">Recent Week</label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" id="month" type="radio" name="timeRange" value="{{date('Y-m-d H:i:s',(time()-30*24*3600))}}">
                        <label class="form-check-label" for="gridRadios3">Recent Month</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="timeRange" id="allHistory" value="all">
                        <label class="form-check-label" for="allHistory">All History</label>
                    </div>                                
                    <input id="dhtid" type="hidden" name="dhtid" value="{{$dht->id}}" />
                </div>
                </fieldset>
                <div class="d-inline-flex justify-content-start py-1">
                    <a href="{{url("/devices/{$device[0]->id}")}}" class="btn btn-outline-primary m-1">Go Back</a>
                    <input type="submit" class="btn btn-outline-danger m-1" value="search" />
                </div>  
            </form>
        </div>
    {!! Form::close() !!}   

    <style>
        .card{
            margin-top: 10px;
            background: transparent;
            border: 2px solid rgba(225, 225, 225, .5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            display: flex;
        }
    </style>
@endsection 