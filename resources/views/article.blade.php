@extends('layouts.app')

@section('content')
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            {!! $title !!}
        </div>
        <div class="panel-body">
            {!! $text !!}
        </div>
    </div>

@endsection