@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-info">
            @foreach($users as $user)
                <div class="panel-heading">
                    <label class="lead text-primary">{{ $user->name }}</label>
                </div>
                <div class="panel-body">
                    <p>{{ $user->email}}</p>
                    <p>{{ $user->birthday }}</p>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-info" href="{{ route('users.edit', ['id' => $user->id]) }}">Update</a>
                    <form class="pull-right" action="{{route('users.destroy', ['id' => $user->id])}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                </div>
            @endforeach
        </div>
        {{$users->links()}}
    </div>
@endsection