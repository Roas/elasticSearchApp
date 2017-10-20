@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="center">
            <h3>Enter an advanced search query</h3>
            <a href="{{ route('welcome') }}">Normal search</a>
        </div>
        <br/>
        {!! Form::open(['route' => 'advancedsearch.result', 'method' => 'POST']) !!}

        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'style' => 'width: 100%']) !!}
        {!! Form::text('text', null, ['class' => 'form-control', 'placeholder' => 'Body', 'style' => 'width: 100%']) !!}

        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}

        <p>No query entered :(</p>

        {!! Form::close() !!}
    </div>

@endsection

@section('logo')
    <img src="{{ asset("img/init.jpg") }}" style="width:30%">
@endsection