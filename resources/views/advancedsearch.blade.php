@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="center">
            <h3>Enter an advanced search query</h3>
            <a href="{{ route('welcome') }}">Normal search</a>
        </div>
        <br/>
        {!! Form::open(['route' => 'advancedsearch.result', 'method' => 'GET']) !!}

        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'style' => 'width: 100%']) !!}
        {!! Form::text('text', null, ['class' => 'form-control', 'placeholder' => 'Body', 'style' => 'width: 100%']) !!}

        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
        <br>
        <br>

        @if(Route::currentRouteName() == "advancedsearch.result")
            <p>We found {{ $total }} results in {{ $took }} milliseconds</p>
            @if($results != [])
                @foreach($results as $result)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="{{ route('article', $result['_id']) }}">{{ $result['_source']['title'] }}</a>
                        </div>
                        <div class="panel-body">
                            {{ str_limit($result['_source']['text'], $limit=500, $end='....') }}
                        </div>
                        <div class="panel-footer">
                            <label>Categorieën:</label>
                            @if(count($result['tags']) > 1)
                                @for($i = 1; $i < count($result['tags']); $i++)
                                    <label>{{ $result['tags'][$i] }}</label>
                                    @if($i != count($result['tags']) - 1  || count($result['tags2']) > 1)
                                        &#9679
                                    @endif
                                @endfor
                            @endif
                            @if(count($result['tags2']) > 1)
                                @for($i = 1; $i < count($result['tags2']); $i++)
                                    <label>{{ $result['tags2'][$i] }}</label>
                                    @if($i != count($result['tags2']) - 1)
                                        &#9679
                                    @endif
                                @endfor
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                No results found :(
            @endif
        @endif

        {!! Form::close() !!}
    </div>

@endsection

@section('logo')
    @if(Route::currentRouteName() == "advancedsearch.result")
        @if($results != [])
            <img src="{{ asset("img/search.jpg") }}" style="height:225px">
        @else
            <img src="{{ asset("img/crash.jpg") }}" style="height:225px">
        @endif
    @else
        <img src="{{ asset("img/init.jpg") }}" style="height:225px">
    @endif
@endsection