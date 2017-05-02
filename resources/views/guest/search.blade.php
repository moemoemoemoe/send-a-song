<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from flatfull.com/themes/pulse/player.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:53:51 GMT -->

<head>
	<meta charset="utf-8">
	<title>SendaSong | search</title>
	<meta name="description" content="Music, Musician, Bootstrap">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
	<link rel="apple-touch-icon" href="images/logo.png">
	<meta name="apple-mobile-web-app-title" content="Flatkit">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" sizes="196x196" href="images/logo.png">
	<link rel="stylesheet" href="{{asset('css/animate.css/animate.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/glyphicons/glyphicons.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/material-design-icons/material-design-icons.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/styles/app.min.css')}}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  
 <link rel="stylesheet" href="{{asset('css/styles/app.rtl.css')}}">

</head>

<body dir="rtl">
	<div class="app dk" id="app">
		<div id="aside" class="app-aside modal fade nav-dropdown">
			<div class="left navside grey dk" data-layout="column">
				<div class="navbar no-radius">
					<a href="index.html" class="navbar-brand md">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
							<circle cx="24" cy="24" r="24" fill="rgba(255,255,255,0.2)" />
							<circle cx="24" cy="24" r="22" fill="#1c202b" class="brand-color" />
							<circle cx="24" cy="24" r="10" fill="#ffffff" />
							<circle cx="13" cy="13" r="2" fill="#ffffff" class="brand-animate" />
							<path d="M 14 24 L 24 24 L 14 44 Z" fill="#FFFFFF" />
							<circle cx="24" cy="24" r="3" fill="#000000" />
							
						</svg> <img src="{{asset('images/logo.png')}}" alt="." class="hide"> <span class="hidden-folded inline">@if(\Request::route()->getName() == 'profile')
    
      
        {!! $msg_user !!}
@else خدمة إرسال الأغاني
    @endif </span>
					</a>
				</div>
				<div data-flex class="hide-scroll">
					<nav class="scroll nav-stacked nav-active-primary">
						<ul class="nav" data-ui-nav>
							<li class="nav-header hidden-folded"><span class="text-xs text-muted">@if(Session::has('uniqueid_profile'))
							 <input type="hidden" id="uid_pro" value="{!!Session('phone')!!}" />
							
							
							@endif</span>
							</li>
							<li class="active"><a href="{!! route('home') !!}"><span class="nav-icon"><i class="material-icons">play_circle_outline</i></span> <span class="nav-text">الصفحة الرئيسية</span></a>
							</li>
							
							<li><a href="{!! route('all_artist') !!}"><span class="nav-icon"><i class="material-icons">portrait</i></span> <span class="nav-text">الفنانين</span></a>
							</li>
							<li><input type="text" class="form-control typeahead" id="keyword" placeholder="Type keyword" style="text-align: center;" autocomplete="off" /> 
							<span class="input-group-btn"><div class="form-control" style="text-align: center;" onclick="search()">البحث</div></span>
							</li>
							<li class="nav-header hidden-folded m-t"><span class="text-xs text-muted">Your collection</span>
							</li>
							<li><a href="profile.html#tracks"><span class="nav-label"><b class="label">8</b></span> <span class="nav-icon"><i class="material-icons">list</i></span> <span class="nav-text">Tracks</span></a>
							</li>
							<li><a href="profile.html#playlists"><span class="nav-icon"><i class="material-icons">queue_music</i></span> <span class="nav-text">Playlists</span></a>
							</li>
							<li><a href="profile.html#likes"><span class="nav-icon"><i class="material-icons">favorite_border</i></span> <span class="nav-text">Likes</span></a>
							</li>
						</ul>
					</nav>
				</div>
			
			</div>
		</div>
		<div id="content" class="app-content white bg box-shadow-z2" role="main">
			<div class="app-header hidden-lg-up white lt box-shadow-z1">
				<div class="navbar">
					<a href="index.html" class="navbar-brand md">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
							<circle cx="24" cy="24" r="24" fill="rgba(255,255,255,0.2)" />
							<circle cx="24" cy="24" r="22" fill="#1c202b" class="brand-color" />
							<circle cx="24" cy="24" r="10" fill="#ffffff" />
							<circle cx="13" cy="13" r="2" fill="#ffffff" class="brand-animate" />
							<path d="M 14 24 L 24 24 L 14 44 Z" fill="#FFFFFF" />
							<circle cx="24" cy="24" r="3" fill="#000000" />
						</svg> <img src="{{asset('images/logo.png')}}" alt="." class="hide"> <span class="hidden-folded inline">خدمة إرسال الأغاني</span>
					</a>
					<ul class="nav navbar-nav pull-right" style="direction: ltr">
						<li class="nav-item"><a data-toggle="modal" data-target="#aside" class="nav-link"><i class="material-icons">menu</i></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="app-footer app-player grey bg">
				<div class="playlist" style="width:100%"></div>
			</div>
			<div class="app-body" id="view">
				<div class="page-content">
					<div class="padding p-b-0">
						<div class="page-title m-b">

						 @if(session()->has('message'))
    <h4 class="inline m-a-0">{!! session()->get('message') !!}</h4>
    @endif

    @if(\Request::route()->getName() == 'profile')
    <h4 class="inline m-a-0" style="font-size: 1em;float: right;"><i class="fa fa-calendar"></i>&nbsp &nbsp{!! $msg_date !!}</h4>
<br/>
       <h4 class="inline m-a-0" style="font-size: 1em;float: right;"><i class="fa fa-shopping-cart" >
       	
       </i>&nbsp &nbsp{!!$msg !!}</h4>
       

    
    @endif
<br/>
							<h1 class="inline m-a-0">نتائج البحث </h1>
						</div>
						<div class="row-col">
		<div class="p-a-lg h-v row-cell v-m">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					
					<div id="search-result" class="animated fadeIn">
						<p class="m-b-md"><strong>{!!$search_res_count!!}</strong> <span class="text-muted">Results found for:</span><strong>{!!$keyword!!}</strong>
						</p>
						<div class="row">
							<div class="col-sm-10">
								<div class="row item-list item-list-sm item-list-by m-b">
									
									@foreach($search_res as $res)
									
									<div class="col-xs-12">
										<div class="item">
											<div class="item-media rounded">
												<a href=" " class="item-media-content" style="background-image: url('{{asset('images/artists/'.$res->artist->photo_name)}}')"></a>
											</div>
											<div class="item-info">
												<div class="item-title text-ellipsis">{{$res->original_name}}
													<div class="text-sm text-muted" onclick="modal_form_send('{{$res->song_code}}')">إرسال</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach

								</div>

							</div>
						</div>

									{{ $search_res->links() }}
					</div>
					
				</div>
			</div>
			<form  class="m-b-md">
						<div class="row-col">
				<div class="col-lg-9  b-r no-border-md">
					<div class="padding">
						<h2 class="widget-title h4 m-b">الأكثر ارسلا</h2>
						<div style="direction: ltr" class="owl-carousel owl-theme owl-dots-center" data-ui-jp="owlCarousel" data-ui-options="{
						margin: 20,
						responsiveClass:true,
						responsive:{
						0:{
						items: 2
					},
					543:{
					items: 3
				}
			}
		}"> 

		@foreach($songs_most as $most)
		<div class="" >
			<div class="item r" data-id="item-2" data-src="http://api.soundcloud.com/tracks/259445397/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
				<div class="item-media item-media-4by3">
					<a href=" " class="item-media-content" style="background-image: url('{{asset('images/artists/'.$most->artist->photo_name)}}')"></a>
					<div class="item-overlay center">
						<button class="btn-playpause">Play</button>
					</div>
				</div>
				<div class="item-info">
					<div class="item-overlay bottom text-right"><i onclick="modal_form_send('{{$most->song_code}}')" class="fa fa-share">&nbsp;</i><span style="font-weight:400;color:white;" onclick="modal_form_send('{{$most->song_code}}')" >إرسال</span></a>
						<div class="dropdown-menu pull-right black lt"></div>
					</div>
					<div class="item-title text-ellipsis"><a href=" ">{{$most->artist->original_name}}</a>
					</div>
					<div class="item-author text-sm text-ellipsis"><a href=" " class="text-muted">{{$most->original_name}}</a>
					</div>
				</div>
			</div>
		</div>

		@endforeach
	</div>
					</form>
		</div>
	
</div>



		</div>
		
		
	</div>
</div>
</div>
</div>
</div>
</div>


<div id="share-modal" class="modal fade animate">
	<div class="modal-dialog">
		<div class="modal-content fade-down">
			<div class="modal-header">
				<h5 class="modal-title">إرسال</h5>
			</div>
			<div class="modal-body p-lg">
				<div id="share-list" class="m-b"><a href="#" class="btn btn-icon btn-social rounded btn-social-colored indigo" title="Facebook"><i class="fa fa-facebook"></i> <i class="fa fa-facebook"></i></a> <a href="#" class="btn btn-icon btn-social rounded btn-social-colored light-blue" title="Twitter"><i class="fa fa-twitter"></i> <i class="fa fa-twitter"></i></a> <a href="#" class="btn btn-icon btn-social rounded btn-social-colored red-600" title="Google+"><i class="fa fa-google-plus"></i> <i class="fa fa-google-plus"></i></a> <a href="#" class="btn btn-icon btn-social rounded btn-social-colored blue-grey-600" title="Trumblr"><i class="fa fa-tumblr"></i> <i class="fa fa-tumblr"></i></a> <a href="#" class="btn btn-icon btn-social rounded btn-social-colored red-700" title="Pinterst"><i class="fa fa-pinterest"></i> <i class="fa fa-pinterest"></i></a>
				</div>
				<div>
					<input class="form-control" value="http://plamusic.com/slug">
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
<script src="{{asset('scripts/app.min.js')}}"></script>
@if(Session::has('uniqueid_profile'))

@include('modales/formsend_profile')
@include('scripts/fuctions_profile')
@else 
@include('modales/formsend')
@include('scripts/fuctions')
@endif

</body>
<!-- Mirrored from flatfull.com/themes/pulse/player.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:53:51 GMT -->

</html>