@extends('layouts.app')

@section('content')
    @guest
    @else
        <a href="{{route('forums.create')}}"><button class="btn btn-primary btn-lg btn-create"  type="submit"><span class="glyphicon glyphicon-plus"></span></button></a>
    @endguest
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <form action="{{ route('home') }}" method="get" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search Forum by Title and Category Name"><span class="input-group-btn">
                                <button class="btn btn-primary"  type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>

                    @foreach($forums as $forum)
                        <div class="well home-pad">
                            <a href="{{ route('forums.show', $forum->id) }}"><strong>{{$forum->title}}</strong></a>
                            @if($forum->forum_status_id == 2)
                                <label class="label label-danger pull-right"  >{{$forum->forum_status->name}}</label><br>
                            @else
                                <label class="label label-success pull-right"  >{{$forum->forum_status->name}}</label><br>
                            @endif
                            Category: {{$forum->category->name}} <br>
                            Posted at: {{$forum->created_at->format('d M Y H:i:s')}}
                            <div>
                                <li class="list-group-item content-group">{{$forum->description}}</li>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center">
                        <div>
                            {{ $forums->links() }}
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection