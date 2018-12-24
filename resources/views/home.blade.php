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
                    {{$forum->title}} <button>{{$forum->forum_status->name}}</button><br>
                    Category: {{$forum->category->name}} <br>
                    Posted at: {{$forum->created_at->format('d M Y H:i:s')}} <br>
                    {{$forum->description}}
                </div><br>
                @endforeach

                <div style="text-align: center;">
                    {{ $forums->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
