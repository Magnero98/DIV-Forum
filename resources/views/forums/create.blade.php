@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                	<form class="form-horizontal" method="POST" action="{{ route('forums.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <table>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" value="{{$input['name']}}"/></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="text" name="price" value="{{$input['price']}}"/></td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><input type="file" name="image"/></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection 