@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <form id="search-form" class="panel-heading form-horizontal" action="{{ route('forums.show', ['id' => $forum_id]) }}" method="GET">
                <div class="input-group">
                    <span class="input-group-addon">Search Thread</span>
                    <input id="keyword" type="text" class="form-control" name="keyword" placeholder="Search This Forum's Threads by Content or Owner">
                    <span class="input-group-addon" onclick="document.getElementById('search-form').submit();"><i class="fa fa-search"></i></span>
                </div>
            </form>
        </div>
        <div class="row">
            @foreach($threads as $thread)
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p>{{ $thread->forum_id }}</p>
                        <p>{{ $thread->user->name }}</p>
                    </div>
                    <div class="panel-body">
                        {{ $thread->content }}
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-info" href="{{ route('threads.edit', ['thread' => $thread]) }}">Update</a>
                        <form action="{{ route('threads.update', ['id' => $thread->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            @endforeach
            {{ $threads->links() }}
        </div>
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('threads.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="content" class="col-md-4 control-label">Content</label>

                    <div class="col-md-6">
                        <input id="content" type="text" class="form-control" name="content" placeholder="Write something..." required>
                    </div>
                </div>

                <input type="hidden" name="forum_id" value="{{ $forum_id }}">
                <input type="hidden" name="user_id" value="{{ authUserDomain()->getId() }}">

                <div class="form-group" style="padding-top: 20px">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection