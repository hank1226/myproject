@extends('layouts.app')

@section('content')
<br>
    <h1>Devices</h1>
    @if(count($devices) > 0)
        @foreach($devices as $device)    
              <div class="card" style = "">
                <h3 class="card-header"><a href="{{ url('devices/'.$device->id) }}">{{ $device->name }}</a></h3>
                <div class="card-body">
                    <P class="card-text">Written on {{ $device->created_at }}</P>
                    {{-- <div>
                        <a href="{{ url('devices/'.$device->id) }}" class="btn btn-primary">View</a>
                    </div> --}}
                </div>
              </div>
        @endforeach  
    @else
        <p>No devices found</p>    
    @endif




    <style>
        .card {
            background: rgba(255, 255, 255, 0.2);
            color: #162938;
            outline: none;
            border: none;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .card-header a{
            text-decoration: none;
            color: black;
        }

        .card-header a:hover {
            color: blue;
        }
    </style>
@endsection 

