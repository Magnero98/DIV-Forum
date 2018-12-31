@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="w-100 p-3">
				<div class="panel panel-default">
					<div class="panel-heading"><span class="text-primary lead"><b>List of Forum</b></span></div>

					<div class="panel-body table-responsive">
						<table class="table table-striped table-hover">
							<thead>
							<tr>
								<th class="text-center">Name</th>
								<th class="text-center">Category</th>
								<th class="text-center">Owner</th>
								<th class="text-center">Description</th>
								<th class="text-center">Status</th>
								<th class="text-center forum-action">Action</th>
							</tr>
							</thead>

							<tbody>
							@foreach($forums as $forum)
								<tr>
									<td style="vertical-align: middle" class="text-center">{{ $forum->title }}</td>
									<td style="vertical-align: middle" class="text-center">{{ $forum->category->name}}</td>
									<td style="vertical-align: middle" class="text-center">{{ $forum->user->name }}</td>
									<td style="vertical-align: middle" class="text-center">{{ $forum->description }}</td>
									<td style="vertical-align: middle" class="text-center">
										@if($forum->forum_status_id == 2)
											<label class="label label-danger"  >{{$forum->forum_status->name}}</label><br>
										@else
											<label class="label label-success"  >{{$forum->forum_status->name}}</label><br>
										@endif
									</td>
									<td style="vertical-align: middle" class="text-center width-forum">
										<form action="{{ url('forums/'.$forum->id.'/updateStatus') }}" method="post">
											{{csrf_field()}}
											<button @if($forum->forum_status_id == 2) disabled @endif class="btn btn-warning btn-block"><span class="glyphicon glyphicon-remove"></span> Close</button>
										</form>
										<br>
										<form action="{{route('forums.destroy', $forum->id)}}" method="post">
											{{csrf_field()}}
											<input type="hidden" name="_method" value="delete"/>
											<button class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>

					<div class="panel-footer">
						<div class="text-center">
							{{ $forums->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection 