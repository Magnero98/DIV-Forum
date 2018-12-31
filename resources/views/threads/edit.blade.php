@extends('layouts.app')

@section('content')
    <div class="container">
        <div  class="row">
            <div class="panel panel-default">
                <div class="well well-sm"><span class="text-primary lead"><b>Edit Thread Content</b></span></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('threads.update', ['id' => $thread->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">

                            <div  class="col-md-12">
                                <label for="content" class="col-md-0 control-label">Content</label>
                            </div>
                            <div>
                                <textarea id="content" type="text" class="form-control" name="content" rows="3" required placeholder="Write Something Here !!"  value="{{ $thread->content}}" required></textarea>
                            </div>

                            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}">
                            <input type="hidden" name="_method" value="PUT">

                            <div class="home-pad">
                                <button type="submit" class="btn btn-primary btn-sm pull-right" ><span class="glyphicon glyphicon-send btn-send"></span>Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection