@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="w-100 p-3">
                <div class="panel panel-default">
                    <div class="well well-sm">
                        List of User
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-xs pull-right">Add New User</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
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
                                    <td width="150" height="100">
                                        <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}" alt="" class="img-user">
                                    </td>
                                    <td class="vertic-body">{{ $user->name }}</td>
                                    <td style="vertical-align: middle">{{ roleName($user->role_id) }}</td>
                                    <td style="vertical-align: middle">{{ $user->email }}</td>
                                    <td style="vertical-align: middle">{{ $user->phone }}</td>
                                    <td style="vertical-align: middle">{{ $user->address }}</td>
                                    <td style="vertical-align: middle">{{ $user->birthday }}</td>
                                    <td style="vertical-align: middle">{{ $user->gender }}</td>
                                    <td style="vertical-align: middle">
                                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-xs btn-on-list"><span class="glyphicon glyphicon-edit btn-sz"></span></a>
                                        <form class="pull-right" action="{{route('users.destroy', ['id' => $user->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-xs pull-right btn-on-list" type="submit" value="Delete"><span class="glyphicon glyphicon-trash btn-sz"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation" align="center">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endsection