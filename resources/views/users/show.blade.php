@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron row">
            <div class="col-md-2">
                <img src="{{ asset('uploads/profile_pictures' . $user->profile_picture) }}">
            </div>
            <div class="col-md-8">
                <div>
                    <label>Name</label>
                    {{ $user->name }}
                </div>
                <div>
                    <label>Popularity</label>
                    <span class="badge">+ {{ $user->good_popularity }}</span>
                    <span class="badge">- {{ $user->bad_popularity }}</span>
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
            </div>
            <div class="col-md-2">
                @roles(['User', 'Admin'])
                    @if(isAuthUserProfile($user->id))
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}">Edit</a>
                    @else
                        <div>
                            <label>Give Popularity</label>
                            @if(getUserPopularityVote($user->id) == "Good")
                                <a class="btn btn-default" disabled href="{{ route('popularities.good', ['userId' => $user->id]) }}">+</a>
                                <a class="btn btn-default" href="{{ route('popularities.bad', ['userId' => $user->id]) }}">-</a>
                            @elseif(getUserPopularityVote($user->id) == "Bad")
                                <a class="btn btn-default" href="{{ route('popularities.good', ['userId' => $user->id]) }}">+</a>
                                <a class="btn btn-default" disabled href="{{ route('popularities.bad', ['userId' => $user->id]) }}">-</a>
                            @else
                                <a class="btn btn-default" href="{{ route('popularities.good', ['userId' => $user->id]) }}">+</a>
                                <a class="btn btn-default" href="{{ route('popularities.bad', ['userId' => $user->id]) }}">-</a>
                            @endif
                        </div>
                    @endif
                @endroles
            </div>
        </div>
        <div class="container-fluid">
            <form action="{{ route('messages.store') }}" method="POST">
                <label>Message</label>
                <br>
                <textarea rows="3" name="content"></textarea>
                <br>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
@endsection