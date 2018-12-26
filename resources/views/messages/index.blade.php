@extends ('layouts.app')

@section('content')

    @if(!$messages->isEmpty())
    <table style="margin:auto">
        <tr>
            <th width="20%">Name</th>
            <th width="20%">Created At</th>
            <th width="20%">Content</th>
            <th width="20%">Delete</th>
        </tr>
        @foreach($messages as $message)
            <tr>
                <td>{{$message->User::find($message->sender_id)->name}}</td>
                <td>{{$message->created_at->format('l, d-M-Y H:i:s')}}</td>
                <td>{{$message->content}}</td>
                <td>
                    <form action="{{route('messages.destroy', $message->id)}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="delete"/>
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        {{ $messages->link() }}
    </table>
    @else
    <h1>There is no message yet...</h1>
    @endif
@endsection
