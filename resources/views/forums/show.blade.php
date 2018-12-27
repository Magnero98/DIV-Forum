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

        <div class="container-fluid">
            @foreach($threads as $thread)
                <div class="panel panel-default">
                    {{ $thread->user->name }}<br>
                    {{ $thread->user->role->name }}<br>
                    {{ $thread->created_at }}<br>
                    {{ $thread->content }}<br>
                    <a href="{{ route('threads.edit', ['thread' => $thread]) }}">Update</a>
                    <form action="{{ route('threads.update', ['id' => $thread->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            @endforeach
            {{ $threads->links() }}
        </div>

        <div class="container-fluid">
            <form method="POST" action="{{ route('threads.store') }}">
                {{ csrf_field() }}
                <div>
                    <label for="content">Content</label>
                    <input id="content" type="text" name="content" placeholder="Write something..." required>
                </div>

                <input type="hidden" name="forum_id" value="{{ $forum_id }}">
                <input type="hidden" name="user_id" value="{{ authUserDomain()->getId() }}">

                <div>
                    <button type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection