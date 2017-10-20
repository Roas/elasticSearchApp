@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="center">
            <h3>Enter a search query</h3>
            <a href="{{ route('advancedsearch') }}">Advanced search</a>
        </div>
        <br/>
        {!! Form::open(['route' => 'result', 'method' => 'GET']) !!}

        <div class="form-group">
            <div class="input-group">
                {!! Form::text('query', null, ['class' => 'form-control']) !!}
                <span class="input-group-btn">
                {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                </span>
            </div>
        </div>

        No query entered :(

        {!! Form::close() !!}
    </div>

@endsection

@section('logo')
    <img src="{{ asset("img/init.jpg") }}" style="width:30%">
@endsection