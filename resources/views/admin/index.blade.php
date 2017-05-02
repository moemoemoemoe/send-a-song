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
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
 
@endsection
