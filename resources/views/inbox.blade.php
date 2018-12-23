@extends ('layouts.app')

@section('content')
    <table style="margin:auto">
        <tr>
            <th width="40%">Name</th>
            <th>Created At</th>
            <th>Content</th>
            <th>Delete</th>
        </tr>
        @foreach($messages as $message)
            <tr>
                <td>{{$message->User::find($message->sender_id)->name}}</td>
                <td>{{$message->created_at}}</td>
                <td>{{$message->content}}</td>
                <td>
                    <form action="{{url('inbox/'.$message->id)}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="delete"/>
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
