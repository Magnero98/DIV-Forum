@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    @guest
                    Welcome, Guest..
                    @else 
                    Welcome, {{App\Domains\DomainModels\UserDomainModel::getAuthUser()->getName()}}
                    @endguest

                </div><br>

                @foreach($forums as $forum)
                <div class="panel-body">
                    {{$forum->title}} <br>
                    {{$forum->category_id}} <br>
                    {{$forum->created_at}} <br>
                    {{$forum->description}}
                </div><br>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
