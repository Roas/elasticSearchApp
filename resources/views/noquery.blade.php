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
        <a href="{{ route('result', ['facet' => 'Land']) }}">Land</a>
        <a href="{{ route('result', ['facet' => 'Dier']) }}">Dier</a>
        <a href="{{ route('result', ['facet' => 'Sport']) }}">Sport</a>
        <a href="{{ route('result', ['facet' => 'Televisie']) }}">Televisie</a>
        <a href="{{ route('result', ['facet' => 'Internet']) }}">Internet</a>
        <a href="{{ route('result', ['facet' => 'Muziek']) }}">Muziek</a>
        <a href="{{ route('result', ['facet' => 'Beroep']) }}">Beroep</a>
        <a href="{{ route('result', ['facet' => 'Geneeskunde']) }}">Geneeskunde</a>
        <a href="{{ route('result', ['facet' => 'Economie']) }}">Economie</a>
        <a href="{{ route('result', ['facet' => 'Politiek']) }}">Politiek</a>

        <p>No query entered :(</p>

        {!! Form::close() !!}
    </div>

@endsection

@section('logo')
    <img src="{{ asset("img/init.jpg") }}" style="width:30%">
@endsection