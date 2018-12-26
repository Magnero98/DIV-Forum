@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Forum</div>
                <br>
            <table style="margin:auto">

                @foreach($forums as $forum)
                    <tr>
                        <td>{{$forum->title}}</td>
                        @if($forum->forum_status_id == 1)
                        <td>
                            <form action="{{route('forums.edit', $forum->id)}}" method="get">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="edit"/>
                                <button>Edit </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('forums/'.$forum->id.'/updateStatus') }}" method="post">
                                {{csrf_field()}}
                                <button>Close</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    <tr>
                        <td>
                            Status: {{$forum->forum_status->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{$forum->description}}<br><br></td>
                    </tr>
                @endforeach
            </table>

                <div style="text-align: center;">
                	{{ $forums->links() }}
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection