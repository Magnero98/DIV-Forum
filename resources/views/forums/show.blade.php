@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="panel panel-default">
            <div class="panel-body">
                <div style="font-size: 1.5vw">{{$forum->title}} <button>{{$forum->forum_status->name }}</button></div>
                <div>Category: {{ $forum->category->name }}</div>
                <div>Owner: 
                    @guest 
                    {{ $forum->user->name }}
                    @else
                    <a href="{{ route('users.show', ['id' => $forum->user_id]) }}">{{ $forum->user->name }}</a>
                    @endguest
                </div>
                <div>Posted at: {{ $forum->created_at->format('d M y h:i:s')}}</div><br>
                <div>Description: </div>
                <div>{{ $forum->description }}</div>
            </div>

            <form id="search-form" class="panel-heading form-horizontal" action="{{ route('forums.show', ['id' => $forum->id]) }}" method="GET">
                <div class="input-group">
                    <span class="input-group-addon">Search Thread</span>
                    <input id="keyword" type="text" class="form-control" name="keyword" placeholder="Search This Forum's Threads by Content or Owner">
                    <span class="input-group-addon" onclick="document.getElementById('search-form').submit();"><i class="fa fa-search"></i></span>
                </div>
            </form>
            <p style="margin-left: 1%">Thread Search Results With <b>'{{ request()->get('keyword') }}'</b> Keyword(s): </p>
        </div>

        <div class="container-fluid">
            @if(count($threads) == 0)
                <h1>This forum doesn’t have any thread</h1>
            @else
                @foreach($threads as $thread)
                    <div class="panel panel-default">
                        @guest
                        {{ $thread->user->name }}
                        @else
                        <a href="{{ route('users.show', ['id' => $thread->user->id]) }}">{{ $thread->user->name }}</a>
                        @endguest
                        <br>
                        {{ $thread->user->role->name }}<br>
                        {{ $thread->created_at }}<br>
                        {{ $thread->content }}<br>

                        @roles(['Member', 'Admin'])
                            @if(isAuthUserThread($thread->id))
                                <a href="{{ route('threads.edit', ['thread' => $thread]) }}">Update</a>
                                <form action="{{ route('threads.update', ['id' => $thread->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete">
                                </form>
                            @endif
                        @endroles
                    </div>
                @endforeach
                {{ $threads->links() }}
            @endif
        </div>

        <div class="container-fluid">
            @roles(['Member','Admin'])
                @if($forum->forum_status->name != 'Closed')
                    <form method="POST" action="{{ route('threads.store') }}">
                        {{ csrf_field() }}
                        <div>
                            <label for="content">Content</label>
                            <input id="content" type="text" name="content" placeholder="Write something..." required>
                        </div>

                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                        <input type="hidden" name="user_id" value="{{ authUserDomain()->getId() }}">

                        <div>
                            <button type="submit">Post</button>
                        </div>
                    </form>
                @endif
            @endroles
        </div>
    </div>
@endsection