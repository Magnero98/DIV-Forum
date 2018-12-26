@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" method="POST" action="{{ route('threads.update', ['id' => $thread->id]) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="content" class="col-md-4 control-label">Content</label>

                <div class="col-md-6">
                    <input id="content" type="text" class="form-control" name="content" value="{{ $thread->content}}" required>
                </div>
            </div>

            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}">
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
@endsection