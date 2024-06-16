@extends('layouts.app')

@section('content')
    <br>
    <h2>Edit Device</h2>
    <form action="{{ action('App\Http\Controllers\DevicesController@update', $device->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Device Name</label>
            <input type="text" name="name" class="form-control" placeholder="Device Name" value="{{ $device->name }}">
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea id="article-ckeditor" name="note" class="form-control" placeholder="Note">{{ $device->note }}</textarea>
        </div>
        <button type = "button" class = "btn btn-primary" onclick = "goback()">Go Back</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#article-ckeditor'))
            .catch(error => {
                console.error(error);
        });

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
