@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ $user->name }}
            </div>
            <div class="panel-body">
                {{ $user->good_popularity }}
                {{ $user->bad_popularity }}
            </div>
            <div class="panel-footer">
                <a class="btn btn-success" href="{{ route('popularities.good', ['userId' => $user->id]) }}">Good</a>
                <a class="btn btn-danger" href="{{ route('popularities.bad', ['userId' => $user->id]) }}">Bad</a>
            </div>
        </div>
    </div>
@endsection