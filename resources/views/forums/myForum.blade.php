@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Forum</div>

                @foreach($forums as $forum)
                <div class="panel-body">
                    {{$forum->title}} <br>
                    Status: <button>{{$forum->forum_status->name}}</button><br>
                    {{$forum->description}}
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection