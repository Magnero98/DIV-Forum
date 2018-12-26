@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('threads.update', ['id' => $thread->id]) }}">
            {{ csrf_field() }}
            <div>
                <label for="content">Content</label>
                <input id="content" type="text" name="content" value="{{ $thread->content}}" required>
            </div>

            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}">
            <input type="hidden" name="_method" value="PUT">

            <div>
                <button type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection