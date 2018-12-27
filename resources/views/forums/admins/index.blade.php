@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of Forum</div>

                <div class="panel-heading">
			    	<table>
			    		<tr> 
			    			<th width="15%">Name</th>
			    			<th width="10%">Category</th>
			    			<th width="15%">Owner</th>
			    			<th width="20%">Description</th>
			    			<th width="15%">Status</th>
			    			<th width="15%" colspan="2" style="text-align: center;">Action</th>
			    		</tr>

			    		@foreach($forums as $forum)
			          		<tr>
			          			<td>{{ $forum->title }}</td>
			          			<td>{{ $forum->category->name}}</td>
			          			<td>{{ $forum->user->name }}</td>
			          			<td>{{ $forum->description }}</td>
			          			<td>{{ $forum->forum_status->name}}</td>
			          			<td>
			          				<form action="{{ url('forums/'.$forum->id.'/updateStatus') }}" method="post">
	                                {{csrf_field()}}
	                                <button @if($forum->forum_status_id == 2) disabled @endif >Close</button>
	                            	</form>
	                            </td>
			          			<td>
  				                    <form action="{{route('forums.destroy', $forum->id)}}" method="post">
									    {{csrf_field()}}
									    <input type="hidden" name="_method" value="delete"/>
									    <button>Delete</button>
                    				</form>
			          			</td>
			          		</tr>
			    		@endforeach
			    	</table>
			    	<div style="text-align: center;">
						{{ $forums->links() }}
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 