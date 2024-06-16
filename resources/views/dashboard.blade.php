@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="title">
                        <h3>Your Devices</h3>
                        <a href="{{ url('/devices/create') }}" class="create btn btn-primary">Create Device</a>
                    </div>
                    @if(count($devices) > 0)
                        @foreach($devices as $device)
                        <div class="item">
                                <h3><a href="{{ url('devices/'.$device->id) }}">{{$device->name}}</a></h3>
                                <div class="button">
                                    <a href="{{url ('/devices')}}/{{$device->id}}/edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ url('devices/' . $device->id) }}" method="POST" class="pull-right">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">
                                            <i class="far fa-trash-can" style=""></i>
                                        </button>
                                    </form>
                                </div>
                        </div>
                        
                    @endforeach
                    @else
                        <p>You have no devices</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: `Poppins`, `sans-serif`;
    }

    .card{
        margin-top: 100px;
        background: transparent;
        border: 2px solid rgba(225, 225, 225, .5);
        border-radius: 20px;
        backdrop-filter: blur(20px);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    }

    .create{
        margin-left: auto;
    }

    .title {
        display: flex;
        align-items: center;
    }

    .title a{
        display: flex;
        float : right;
        margin-bottom: 10px;
        justify-content: end;
    }

    .item {
        background: rgba(255, 255, 255, 0.2);
        color: #162938;
        outline: none;
        border: none;
        border-radius: 20px;
        margin-bottom: 10px;
        display: flex; 
        justify-content: space-between;
    }

    .button {
        display: flex; 
        align-items: center;
    }   

    .button .btn {
        background: none; 
        border: none; 
        padding: 0; 
        margin: 0;
    }

    .fa-pen-to-square {
        font-size: 27px; 
        margin-right: 10px;
    }
    
    .fa-trash-can {
        font-size: 27px; 
        color: red;
        margin-right: 10px;
    }

    .item h3 {
        margin: 10px;
        
        text-align: center;
    }

    .item h3 a{
            text-decoration: none;
            color: black;
        }

    .item h3 a:hover {
        color: blue;
    }

</style>
@endsection
