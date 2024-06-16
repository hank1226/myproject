@extends('layouts.app')

@section('content')
{{-- <h1>DHTs</h1>
@if(count($dhts) > 0)
        @foreach($dhts as $dht)
        <div class = "card mb-3" style = "max-width: 18rm;">
            <div class="card-header">{{$dht->name}}</div>
            <div class="card-body text-primary">
                <a href="{{url ('/dhts')}}/{{$dht->id}}/edit" class = "btn btn-primary">Edit</a>
                {!! Form::open(['action' => ['App\Http\Controllers\DHTsController@destroy', $dht->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
        @endforeach

@else
    <p>You have no DHTs</p>
@endif --}}



<p>asdf</p>
@endsection


