@extends('layouts.app')

@section('content')
    <br>
    <h2>Create PZEM</h2>
    <form action="{{action('App\Http\Controllers\PZEMsController@store')}}" method = "POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group">
            <label for="pzem_sn">PZEM sn</label>
            <input type="text" name = "pzem_sn" id = "pzem_sn" class = "form-control" placeholder="pzem_sn">
        </div>
        <div class="form-group">
            <label for="fk_id" class="col-form-label test-md-start">{{ __('Devices Name') }}</label>
            <div class="form-group">
                <select name="fk_id" id="fk_id" class="form-control" autofocus>
                    <option value="">--- Devices Name ---</option>
                    @foreach($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <style>
        button {
            margin-top: 10px;
        }
    </style>
@endsection 