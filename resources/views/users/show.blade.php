@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-profile" src="{{ asset('uploads\\profile_pictures\\' . $user->profile_picture) }}">
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-9">

                                    <div class="padd-prof">
                                        <label>Name</label>
                                        {{ $user->name }}
                                    </div>

                                    <div class="padd-prof">
                                        <label>Popularity</label>
                                        <label class="label label-success"><span class="fa fa-plus"></span> {{ $user->good_popularity }}</label>
                                        <label class="label label-danger"><span class="fa fa-minus"></span> {{ $user->bad_popularity }}</label>
                                    </div>

                                    <div class="padd-prof">
                                        <label>Email</label>
                                        {{ $user->email }}
                                    </div>

                                    <div class="padd-prof">
                                        <label>Phone</label>
                                        {{ $user->phone }}
                                    </div>

                                    <div class="padd-prof">
                                        <label>Birthday</label>
                                        {{ $user->birthday }}
                                    </div>

                                    <div class="padd-prof">
                                        <label>Gender</label>
                                        {{ $user->gender }}
                                    </div>

                                    <div class="padd-prof">
                                        <label>Address</label>
                                        {{ $user->address }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    @roles(['Member', 'Admin'])
                                    @if(isAuthUserProfile($user->id))
                                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary pull-right">Edit</a>
                                    @else
                                        <div class="panel panel-info popularity-box">
                                            <div class="panel-heading">
                                                <label>Give Popularity</label>
                                            </div>
                                            <div class="panel-body">
                                                @if(getUserPopularityVote($user->id) == "Good")
                                                    <a disabled class="btn btn-success"><span class="fa fa-plus"></span></a>
                                                    <a href="{{ route('popularities.bad', ['userId' => $user->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a>
                                                @elseif(getUserPopularityVote($user->id) == "Bad")
                                                    <a href="{{ route('popularities.good', ['userId' => $user->id]) }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                                                    <a disabled  class="btn btn-danger"><span class="fa fa-minus"></span></a>
                                                @else
                                                    <a href="{{ route('popularities.good', ['userId' => $user->id]) }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                                                    <a href="{{ route('popularities.bad', ['userId' => $user->id]) }}"  class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @endroles
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @roles(['Member', 'Admin'])
                    @if(!isAuthUserProfile($user->id))
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form id="send-message" action="{{ route('messages.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div>
                                            <label for="message" class="col-md-0 control-label">Message</label>
                                        </div>
                                        <div>
                                            <input type="hidden" name="receiver_id" value="{{$user->id}}">
                                            <input type="hidden" name="sender_id" value="{{ authUserDomain()->getId() }}">
                                            <textarea type="text" class="form-control" name="content" rows="3" required></textarea>
                                        </div>
                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                        @endif

                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <div class="container-fluid">
                                    <button type="submit" class="btn btn-primary pull-right" onclick="document.getElementById('send-message').submit();"><span class="fa fa-send"></span> Send</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endroles
            </div>
        </div>
    </div>
@endsection