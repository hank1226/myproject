@extends('layouts.app')

@section('content')
    <br>
    <h2>Edit PZEM</h2>
    <form action="{{ action('App\Http\Controllers\PZEMsController@update', $pzem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="pzem_sn">PZEM_sn</label>
            <input type="text" name="pzem_sn" value="{{ $pzem->pzem_sn }}" class="form-control" placeholder="pzem_sn">
        </div>
        <div class="form-group">
            <label for="device_name">Devices Name</label>
            <select name="fk_id" id="device_name" class="form-control" autofocus>
                <option value="{{ $pzem->fk_id }}">--- Devices Name ---</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" onclick="goback()" class="btn btn-primary">Go Back</button>
        {{-- <input type="hidden" name="_method" value="PATCH"> --}}
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

    <script>
        function goback(){
            window.history.back();
        }
    </script>
    <style>
        button {
            margin-top: 10px;
            margin-right: 10px;
        }
    </style>
@endsection 