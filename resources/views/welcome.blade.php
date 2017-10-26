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
        @if(Route::currentRouteName() == "result")
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Land']) }}">Land</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Dier']) }}">Dier</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Sport']) }}">Sport</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Televisie']) }}">Televisie</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Internet']) }}">Internet</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Muziek']) }}">Muziek</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Beroep']) }}">Beroep</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Geneeskunde']) }}">Geneeskunde</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Economie']) }}">Economie</a>
            <a href="{{ route('result', ['query' => $query, 'facet' => 'Politiek']) }}">Politiek</a>
        @else
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
        @endif

        @if(Route::currentRouteName() == "result")
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
    @if(Route::currentRouteName() == "result")
        @if($results != [])
            <img src="{{ asset("img/search.jpg") }}" style="height:225px">
        @else
            <img src="{{ asset("img/crash.jpg") }}" style="height:225px">
        @endif
    @else
        <img src="{{ asset("img/init.jpg") }}" style="height:225px">
    @endif
@endsection