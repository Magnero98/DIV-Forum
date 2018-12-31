@extends('layouts.app')

@section('content')
    <div class="container">
        <div  class="row">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <div class="">
                        <span class="lead"><b>{{$forum->title}}</b></span>
                        <span>
                            @if($forum->forum_status_id == 2)
                                <label class="label label-danger pull-right"  >{{$forum->forum_status->name}}</label><br>
                            @else
                                <label class="label label-success pull-right"  >{{$forum->forum_status->name}}</label><br>
                            @endif
                        </span>
                        <div>Category: {{ $forum->category->name }}</div>
                        <div>Owner: <a href="{{ route('users.show', ['id' => $forum->user_id]) }}">{{ $forum->user->name }}</a></div>
                        <div>Posted at: {{ $forum->created_at->format('d M y h:i:s')}}</div><br>
                        <div>Description: </div>
                        <div>{{ $forum->description }}</div>
                    </div>
                    <br>
                    <form id="search-form" class="form-horizontal" action="{{ route('forums.show', ['id' => $forum->id]) }}" method="GET">
                        <div class="input-group">
                            <input id="keyword" type="text" class="form-control" name="keyword" placeholder="Search This Forum's Threads by Content or Owner">
                            <div class="input-group-btn">
                                <button onclick="document.getElementById('search-form').submit();" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                    </form>
                    @if(request()->get('keyword') != null)
                        <br>
                        <p>Thread Search Results With <b>'{{ request()->get('keyword') }}'</b> Keyword(s): </p>
                    @endif
                </div>

                <div class="container">
                    <br>
                    <div class="panel-default">
                        @if(count($threads) == 0)
                            <h5 class="alert alert-warning">This forum doesn’t have any thread</h5>
                        @else
                            @foreach($threads as $thread)
                                <div class="well well-sm">
                                    <a href="{{ route('users.show', ['id' => $thread->user->id]) }}">{{ $thread->user->name }}</a>
                                    <span >
                                        @roles(['Member', 'Admin'])
                                            @if(isAuthUserThread($thread->id))
                                                <form action="{{ route('threads.update', ['id' => $thread->id]) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="hidden" name="_method" value="DELETE"  type="submit" class="btn btn-danger btn-sm pull-right btn-forum-thread"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                                </form>
                                                <a href="{{ route('threads.edit', ['thread' => $thread]) }}" class="btn btn-warning btn-sm pull-right"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                            @endif
                                        @endroles
                                    </span>
                                    <div>
                                        @if($forum->user->name == $thread->user->name)
                                            Admin
                                        @else
                                            Member
                                        @endif
                                    </div>
                                    <div>
                                        Posted at :
                                        {{ $thread->created_at }}
                                    </div>
                                    <div>
                                        <li class="list-group-item">{{ $thread->content }}</li>
                                    </div>

                                </div>
                            @endforeach
                            {{ $threads->links() }}
                        @endif
                    </div>
                </div>
            </div>




            @roles(['Member','Admin'])
            @if($forum->forum_status->name != 'Closed')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="text-primary lead"><b>Post New Thread</b></span>
                    </div>
                    <div class="panel-body">
                        <form id="post-thread" method="POST" action="{{ route('threads.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="description" class="col-md-0 control-label">Description</label>
                                <textarea id="content" type="text" class="form-control" name="content" rows="3" required placeholder="Write Something Here !!"></textarea>
                            </div>
                            <div>
                                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                <input type="hidden" name="user_id" value="{{ authUserDomain()->getId() }}">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="container-fluid">
                            <button type="submit" class="btn btn-primary pull-right" onclick="document.getElementById('post-thread').submit();"><span class="fa fa-send"></span> Post</button>
                        </div>
                    </div>
                </div>
            @endif
            @endroles
        </div>
    </div>
@endsection