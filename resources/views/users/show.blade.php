@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="well-sm jumbotron">
            <div class="col-md-2">
                <img src="{{ asset('uploads/profile_pictures' . $user->profile_picture) }}">
            </div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <div>
                        <label>Name</label>
                        {{ $user->name }}
                    </div>
                    <div>
                        <label>Popularity</label>

                    </div>
                    <div>
                        <label>Email</label>
                        {{ $user->email }}
                    </div>
                    <div>
                        <label>Phone</label>
                        {{ $user->phone }}
                    </div>
                    <div>
                        <label>Birthday</label>
                        {{ $user->birthday }}
                    </div>
                    <div>
                        <label>Gender</label>
                        {{ $user->gender }}
                    </div>
                    <div>
                        <label>Address</label>
                        {{ $user->address }}
                    </div>

                    <a href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>

                    <div>
                        <label>Give Popularity</label>
                        <a class="btn btn-default" href="{{ route('popularities.good', ['userId' => $user->id]) }}">+</a>
                        <a class="btn btn-default" href="{{ route('popularities.bad', ['userId' => $user->id]) }}">-</a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('messages.store') }}" method="POST">
            <label>Message</label>
            <br>
            <textarea rows="3" name="content"></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
@endsection