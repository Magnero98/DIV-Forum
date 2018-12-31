@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($forums) == 0)
                <div class="col-md-8 col-md-offset-2">
                    <h5 class="alert alert-warning">You haven't post any forum yet!</h5>
                </div>
            @else
                <div class="col-md-8 col-md-offset-2">
                    @foreach($forums as $forum)
                        <div class="well home-pad">
                            <div>
                                <a href="{{ route('forums.show', $forum->id) }}"><strong>{{$forum->title}}</strong></a>
                                @if($forum->forum_status_id == 1)
                                    <form class="pull-right" action="{{ url('forums/'.$forum->id.'/updateStatus') }}" method="post">
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-sm pull-right btn-forum-thread" ><span class="glyphicon glyphicon-trash"></span>Close</button>
                                    </form>

                                    <form class="pull-right" action="{{route('forums.edit', $forum->id)}}" method="get">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="edit"/>
                                        <button class="btn btn-warning btn-sm pull-right "><span class="glyphicon glyphicon-edit"></span>Edit</button>
                                    </form>
                                @endif
                            </div>
                            <div>
                                Status :
                                @if($forum->forum_status_id == 2)
                                    <label class="label label-danger"  >{{$forum->forum_status->name}}</label><br>
                                @else
                                    <label class="label label-success"  >{{$forum->forum_status->name}}</label><br>
                                @endif
                                Category: {{$forum->category->name}} <br>
                                Posted at: {{$forum->created_at->format('d M Y H:i:s')}}
                            </div>
                            <div>
                                <li class="list-group-item">{{$forum->description}}</li>
                            </div>


                        </div>
                    @endforeach

                    <div class="text-center">
                        {{ $forums->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection