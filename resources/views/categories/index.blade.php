@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add New Category</div>

                <div class="panel-body">
	            	<form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
	                    {{ csrf_field() }}

	                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                        <label for="name" class="col-md-4 control-label">Name</label>

	                        <div class="col-md-6">
	                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

	                            @if ($errors->has('name'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('name') }}</strong>
	                                </span>
	                            @endif
	                        </div>
	                    </div>

	                    <div class="form-group" style="padding-top: 20px">
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
                <div class="panel-heading">List of Forum Category</div>

                <div class="panel-heading">
			    	<table align="center">
			    		<tr> 
			    			<th width="30%">ID</th>
			    			<th width="30%">Name</th>
			    			<th width="30%" colspan="2" style="text-align: center;">Action</th>
			    		</tr>

			    		@foreach($categories as $category)
			          		<tr>
			          			<td>{{ $category->id }}</td>
			          			<td>{{ $category->name}}</td>
			          			<td>
			          				<form action="{{ route('categories.edit', $category->id) }}" method="get">
	                                {{csrf_field()}}
	                                <button>Edit</button>
	                            	</form>
	                            </td>
			          			<td>
  				                    <form action="{{route('categories.destroy', $category->id)}}" method="post">
									    {{csrf_field()}}
									    <input type="hidden" name="_method" value="delete"/>
									    <button>Delete</button>
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