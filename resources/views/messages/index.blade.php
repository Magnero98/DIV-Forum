@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(!$messages->isEmpty())
                    @foreach($messages as $message)
                        <div class="well">
                            <div>
                                <label class="text-primary>"><a href="{{ route('users.show', ['id' => $message->user->id ]) }}">{{$message->user->name}}</a></label>
                                <form class="pull-right" action="{{route('messages.destroy', $message->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button class="btn btn-danger btn-sm pull-right" ><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </form>
                            </div>
                            <div>
                                {{$message->created_at->format('l, d-M-Y H:i:s')}}
                            </div>
                            <li class="list-group-item footer-thread">{{$message->content}}</li>
                        </div>
                    @endforeach
                    {{ $messages->links() }}
                @else
                    <h1>There is no message yet...</h1>
                @endif
            </div>
        </div>
    </div>
@endsection