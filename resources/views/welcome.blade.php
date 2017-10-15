@extends('layouts.app')

@section('content')

    <div class="row">
        <h3>Enter a search query</h3>
        {!! Form::open(['route' => 'result', 'method' => 'POST']) !!}

        <div class="form-group">
            <div class="input-group">
                {!! Form::text('query', null, ['class' => 'form-control']) !!}
                <span class="input-group-btn">
                {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                </span>
            </div>
        </div>

        @if(Route::currentRouteName() == "result")
            Results!!!
        @endif

        {!! Form::close() !!}
    </div>

@endsection