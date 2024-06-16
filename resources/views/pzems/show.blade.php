@extends('layouts.app')

@section('content')
    <h1>{{$pzem->pzem_sn}}</h1>
    <a href="{{url ('/pzems')}}" class = "btn btn-primary">Go Back</a>
    <br><br>

    <hr>
    <small>fk_id {{$pzem->fk_id}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $pzem->user_id)
            <a href="{{ url('/pzems')}}/{{$pzem->id}}/edit" class="btn btn-default">Edit</a>
            {!! Form::open(['action' => ['App\Http\Controllers\PZEMsController@destroy', $pzem->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
        @endif
    @endif
@endsection
