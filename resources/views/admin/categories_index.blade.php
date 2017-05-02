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

				<div class="panel-heading" style="font-weight: 900">Categories <span style="float:right"><a href="{!! route('create_category') !!}" class="form-control btn btn-primary pull-right">New Category</span></a></div>
				
				<br/>

 <div class="row">
                                                            
@foreach($categories as $category)
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <b>{{$category->original_name}}</b> <span class="pull-right">

                @if($category->is_active == 1)
              <a href="{{route('publish_category', $category->id)}}">   <i class="fa fa-check text-success" title="Active .. press to unpublish"></i></a>
@else              <a href="{{route('publish_category', $category->id)}}">  <i class="fa fa-times-circle" aria-hidden="true" title="Not Active..please publish it on click"></i></a>
@endif
                </span>
            </div>
            <div class="panel-body" style="height:150px; background: url('{{asset('images/categories/'.$category->photo_name)}}'); background-size: cover; background-position: center center">
                
            </div>
            <div class="panel-footer text-center">
                <a href="{!! route('view_category', ['id'=>$category->id]) !!}" class="btn btn-primary form-control">more ...</a>
            </div>
        </div>
    </div>

    @endforeach
    </div>
				</div>
			</div>


		</div>
	</div>
</div>
@endsection
