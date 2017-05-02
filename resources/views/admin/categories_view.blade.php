@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3 ">
			<div class="panel panel-default">
				<div class="panel-heading" style="font-weight: 900">Dashboard</div>

				<div class="panel-body">
					<ul class="list-group" >
					<li style="color : #3cba54" class="list-group-item"><i class="fa fa-home"></i><span> Home</span></li>
						<li style="color : #f4c20d" class="list-group-item"><i class="fa fa-music"></i><span> Manage Songs</span></li>
						<a style="text-decoration: none" href="{!! route('manage_categories_index') !!}"><li style="color : #db3236" class="list-group-item"><i class="fa fa-paperclip"></i><span> Manage Categories</span></li></a>
						<li style="color : #4885ed" class="list-group-item"><i class="fa fa-microphone"></i><span> Manage Artists</span></li>
						<li style="color : #6611cc" class="list-group-item"><i class="fa fa-list"></i><span> The Black List</span></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-9 ">
			  <div class="row">
                    <div class="col-md-9"><h3 class="text text-primary">Update category</h3></div>
                    <div class="col-md-3"><h4></h4></div>
                </div>
                <hr />
                <div class="row">
                                                            
<form method="POST" enctype="multipart/form-data" class="well">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<p>
		<input type="text" name="original_name" placeholder="Original name" class="form-control" value="{{$category->original_name}}">
	</p>
	<p>
		<input type="text" name="foreign_name" placeholder="Foreign name" class="form-control" value="{{$category->foreign_name}}">
	</p>
	<p>
		<textarea type="text" name="details" placeholder="Details" class="form-control" value="">{{$category->details}}</textarea>
	</p>
	<p>
		<b>Current photo</b>
	</p>
	<p>
		<img src="{{asset('images/categories/'.$category->photo_name)}}" class="img img-responsive" style="width:200px" />
	</p>
	<p>
		<b>
			Change photo
		</b>
	</p>
	
	<p>
		<input type="file" name="photo" placeholder="Photo" class="form-control">
	</p>
	<p>
		<input type="submit" value="Update" class="btn btn-primary form-control">
	</p>
</form>

                </div>
		</div>
	</div>
</div>
@endsection
