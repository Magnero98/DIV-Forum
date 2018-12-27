@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('users.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') != null ? old('name') : $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Role</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role_id" required>
                                        <option value="1" {{ old('role_id') == adminRole() ? 'selected' : $user->role_id }}>Admin</option>
                                        <option value="2" {{ old('role_id') == memberRole() ? 'selected' : $user->role_id }}>Member</option>
                                    </select>
                                    @if ($errors->has('role_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') != null ? old('email') : $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') != null ? old('password') : $user->password }}" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') != null ? old('password_confirmation') : $user->password }}" required>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') != null ? old('phone') : $user->phone }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <textarea id="address" type="text" class="form-control" name="address" rows="3" required>{{ old('address') != null ? old('address') : $user->address}}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <label for="birthday" class="col-md-4 control-label">Birthday</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{ old('birthday') != null ? old('birthday') : $user->birthday }}" required>

                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>Must be older than 12 years old.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6 radio">
                                    <label>
                                        <input type="radio" name="gender" value="Male" required {{ old('gender') == 'Male' ? 'checked' : ($user->gender == 'Male') ? 'checked' : '' }}>Male
                                    </label>
                                    <label>
                                        <input type="radio" name="gender" value="Female" required {{ old('gender') == 'Female' ? 'checked' : ($user->gender == 'Female') ? 'checked' : '' }}>Female
                                    </label>
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('picture') ? ' has-error' : '' }}">
                                <label for="picture" class="col-md-4 control-label">Photo</label>

                                <div class="col-md-6">
                                    <input id="picture" type="file" name="picture" required>

                                    @if ($errors->has('picture'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="_method" value="PUT">

                            <div class="form-group" style="padding-top: 20px">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
