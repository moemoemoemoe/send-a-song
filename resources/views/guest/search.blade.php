<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from flatfull.com/themes/pulse/player.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:53:51 GMT -->

<head>
	<meta charset="utf-8">
	<title>SendaSong | Home</title>
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


</head>

<body>

<div >
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
												<div class="item-title text-ellipsis"><a href=" ">{{$res->original_name}}</a>
													<div class="text-sm text-muted">Share</div>
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
				<div class="col-lg-9 b-r no-border-md">
					<div class="padding">
						<h2 class="widget-title h4 m-b">Most Sending</h2>
						<div class="owl-carousel owl-theme owl-dots-center" data-ui-jp="owlCarousel" data-ui-options="{
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
		<div class="">
			<div class="item r" data-id="item-2" data-src="http://api.soundcloud.com/tracks/259445397/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
				<div class="item-media item-media-4by3">
					<a href=" " class="item-media-content" style="background-image: url('{{asset('images/artists/'.$most->artist->photo_name)}}')"></a>
					<div class="item-overlay center">
						<button class="btn-playpause">Play</button>
					</div>
				</div>
				<div class="item-info">
					<div class="item-overlay bottom text-right"><i onclick="modal_form_send('{{$most->song_code}}')" class="fa fa-share">&nbsp;</i><span style="font-weight:400;color:white;" onclick="modal_form_send('{{$most->song_code}}')" >Share</span></a>
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