@extends('layouts.app')

@section('content')
    <br>
    <h2>Create Device</h2>
    <form action="{{ action('App\Http\Controllers\DevicesController@store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Device Name</label>
            <input type="text" name="name" class="form-control" placeholder="Device Name">
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note" class="form-control" id="article-ckeditor" placeholder="Note"></textarea>
        </div>
        <button type = "button" class = "btn btn-primary" onclick = "goback()">Go Back</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>    
@endsection 

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#article-ckeditor' ) )
        .catch( error => {
            console.error( error );
    } );

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
