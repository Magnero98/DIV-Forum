@extends('layouts.app')

@section('content')

	<div class="container" xmlns="http://www.w3.org/1999/html">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="text-primary lead"><b>Add New Category</b></span>
					</div>

					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label"><span class="star">* </span>Name</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

									@if ($errors->has('name'))
										<span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
									@endif
								</div>
							</div>

							<div class="form-group ">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Add
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="text-primary lead"><b>List of Forum Category</b></span>
					</div>

					<div class="panel-body table-responsive">
						<table class="table">
							<tr>
								<th class="text-center">ID</th>
								<th class="text-center">Name</th>
								<th class="text-center content-thread">Action</th>
							</tr>

							@foreach($categories as $category)
								<tr>
									<td class="text-center">{{ $category->id }}</td>
									<td class="text-center">{{ $category->name}}</td>
									<td class="text-center">
										<form class="btn-forum-thread" action="{{ route('categories.edit', $category->id) }}" method="get">
											{{csrf_field()}}
											<button class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit btn-sz" ></span></button>
										</form>

										<form class="btn-forum-thread"  action="{{route('categories.destroy', $category->id)}}" method="post">
											{{csrf_field()}}
											<input type="hidden" name="_method" value="delete"/>
											<button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash btn-sz"></span></button>
										</form>
									</td>
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection 