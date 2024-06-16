@extends('layouts.app')

@section('content')
<br>
    <h1>PZEMs</h1>
    @if(count($pzems) > 0)
        @foreach($pzems as $ps)
            <div class="row mb-3">
                <div class="card">
                    <div class="card-body d-flex" >
                        <div>
                            <h3 class="card-title">PZEM_sn : {{ $ps->pzem_sn }}</h3>
                            @php $found = false; @endphp
                            @if(count($devices) > 0)
                                @foreach($devices as $device)
                                    @if($ps->fk_id == $device->id && !$found)
                                        <p class="card-text">Belongs to <a href="{{ url('devices/'.$device->id) }}">{{$device->name}}</a></p>
                                        @php $found = true; @endphp
                                    @endif
                                @endforeach
                            @endif
                            
                        </div>
                        <div class="d-flex" style = "display: flex; align-items: center;">
                            @foreach($pzem as $p)
                                @if($ps->id == $p->id)
                                    <div class="ml-2">
                                        <a href="{{ url('/pzems')}}/{{$p->id}}/edit">
                                            <i class="fa-solid fa-pen-to-square" style="font-size: 27px; margin-right: 10px;"></i>
                                        </a>
                                    </div>
                                    <div class="ml-2">
                                        <form action="{{ url('pzems/'. $p->id) }}" method="post" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style = "background: none; border: none; padding: 0; margin: 0;">
                                                <i class="far fa-trash-can" style="font-size: 27px; color: red;"></i>
                                            </button>
                                        </form>
                                    </div>                       
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach  
    @else
        <p>No pzems found</p>    
    @endif

    <style>
        .card {
            background: rgba(255, 255, 255, 0.2);
            color: #162938;
            outline: none;
            border: none;
            border-radius: 20px;
        }

        .card-body {
            display: flex; 
            justify-content: space-between;
        }

        .card-text a{
            text-decoration: none;
            color: black;
        }

        .card-text a:hover {
            color: blue;
        }
    </style>
@endsection 