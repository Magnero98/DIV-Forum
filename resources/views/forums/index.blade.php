@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-heading">

                    @guest
                    Welcome, Guest..
                    @else 
                    Welcome, {{App\Domains\DomainModels\UserDomainModel::getAuthUser()->getName()}}
                    @endguest

                </div>

                <form action="{{ route('search') }}" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search"
                            placeholder="Search Forum by Title and Category Name"> 
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span>Search</span>
                            </button>
                        </span>
                    </div>
                </form>

                @foreach($forums as $forum)
                <div class="panel-body">
                    {{$forum->title}} <button>{{$forum->forum_status->name}}</button><br>
                    Category: {{$forum->category->name}} <br>
                    Posted at: {{$forum->created_at->format('d M Y H:i:s')}} <br>
                    {{$forum->description}}
                </div>
                @endforeach

                <div style="text-align: center;">
                    {{ $forums->links() }} 

                    @guest
                    @else
                    <div class="col-md-offset-0">
                        <a href="{{route('forums.create')}}"><button>Add Forum</button></a>
                    </div>
                    @endguest
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
