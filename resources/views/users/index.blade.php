@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="text-primary lead"><b>List of User</b></span>
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-xs pull-right">Add New User</a>
                </div>

                <div class="panel-body table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Birthday</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="center-block">
                                    <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}" width="100" height="100">
                                </td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->name }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ roleName($user->role_id) }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->email }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->phone }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->address }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->birthday }}</td>
                                <td class="text-center" style="vertical-align: middle">{{ $user->gender }}</td>
                                <td class="text-center" style="vertical-align: middle" class="">
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <br>
                                    <form action="{{route('users.destroy', ['id' => $user->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-block" type="submit" value="Delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection