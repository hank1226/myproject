@extends('layouts.app')

@section('content')
    <br>
    <h2>Edit DHT</h2>
    <form action="{{ action('App\Http\Controllers\DHTsController@update', $dht->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="dht_sn">DHT sn</label>
            <input type="text" name="dht_sn" value="{{ $dht->dht_sn }}" class="form-control" placeholder="dht_sn">
        </div>    
        <div class="form-group">
            <label for="device_name">Devices Name</label>
            <select name="fk_id" id="device_name" class="form-control" autofocus>
                <option value="{{ $dht->fk_id }}">--- Devices Name ---</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="button" onclick="goback()" class="btn btn-primary">Go Back</button>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    
    <script>
        function goback() {
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