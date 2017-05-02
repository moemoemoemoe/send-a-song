<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from flatfull.com/themes/pulse/  by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:53:51 GMT -->

<head>
    <meta charset="utf-8">
    <title>Artist</title>
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
<link rel="stylesheet" href="{{asset('css/styles/app.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles/app.rtl.css')}}">

</head>

<body style="direction: rtl;">
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
                            <li><a href="{!! route('home') !!}"><span class="nav-icon"><i class="material-icons">play_circle_outline</i></span> <span class="nav-text">الصفحة الرئيسية</span></a>
                            </li>
                           
                            <li><a href="{!! route('all_artist') !!}"><span class="nav-icon"><i class="material-icons">portrait</i></span> <span class="nav-text">الفنانين</span></a>
                            </li>
                            <li><input type="text" class="form-control typeahead" id="keyword" placeholder="Type keyword" style="text-align: center;" /> 
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
                <div class="pos-rlt">
                    <div class="page-bg" data-stellar-ratio="2" style="background-image: url('{{asset('images/artists/'.$artist_details->photo_name)}}')"></div>
                </div>
                <div class="page-content">
                    <div class="padding b-b">
                        <div class="row-col">
                            <div class="col-sm w w-auto-xs m-b">
                                <div class="item w rounded">
                                    <div class="item-media">
                                        <div class="item-media-content" style="background-image: url('{{asset('images/artists/'.$artist_details->photo_name)}}')"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="p-l-md no-padding-xs">
                                    <div class="page-title">
                                        <h1 class="inline">{{$artist_details->original_name}}</h1>
                                        <label class="fa fa-star text-primary text-lg m-b v-m m-l-xs" title="Pro"></label>
                                    </div>
                                    <p class="item-desc text-ellipsis text-muted" data-ui-toggle-class="text-ellipsis">{{$artist_details->details}}</p>
                                    <div class=" ">
                                        <button class="btn-playpause text-primary m-r-sm"></button> <span>{{$count}} Tracks</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-col">
                        <div class="col-lg-10 b-r no-border-md">
                            <div class="padding">
                                <div class="tab-content">


                                    <div class="col-lg-10">
                                        <div class="padding" style="bottom: 60px" data-ui-jp="stick_in_parent">
                                            <h6 class="text text-muted">Tracks</h6>
                                            <div class="row item-list item-list-sm m-b">



                                               @foreach($songs_artist as $song_art)
                                               <div class="">
                                                <div class="item r" data-id="item-11" data-src="http://api.soundcloud.com/tracks/218060449/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">

                                                    <div class="item-info " >
                                                        <div class="item-title text-ellipsis"><a href=" ">{{$song_art->original_name}}</a>
                                                        </div>
                                                        <div class="item-author text-sm text-ellipsis"><span class="item-meta-stats text-xs"><i class="fa fa-share" ></i>{{$song_art->number_of_send}}</span>
                                                        <div class="" onclick="modal_form_send('{{$song_art->song_code}}')" style="float: right" ><span class="">
                                                  <i class="fa fa-share"></i>إرسال</span>
                                              </div>
                                                        </div>


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
                  <div class="col-lg-3 w-xxl w-auto-md">
                    <div class="padding" style="bottom: 60px" data-ui-jp="stick_in_parent">
                        <h6 class="text text-muted">More Artist</h6>
                        <div class="row item-list item-list-sm m-b">
                            
                          @foreach($artist_more as $more)
                            <div class="col-xs-12">
                                <div class="item r" data-id="item-11" data-src="http://api.soundcloud.com/tracks/218060449/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
                                    <div class="item-media">
                                        <a  class="item-media-content" style="background-image: url('{{asset('images/artists/'.$more->photo_name)}}')"></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-title text-ellipsis"><a href="{!! route('artist', ['id'=>$more->id]) !!}">{{$more->original_name}}</a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        <h6 class="text text-muted">Subscription</h6>
                        <div class="btn-groups"> <ul class="list-group">
                  <li class="list-group-item">اختر الاغنية التي تود ارسالها</li>
                  <li class="list-group-item">ادخل رقم الشخص الذي تود ارسال الاغنية اليه</li>
                  <li class="list-group-item">ادخل رقم هاتفك</li>
                  <li class="list-group-item">ادخل رمز التوثيق الذي سيصلك عبر رسالة قصيرة</li>
                  <li class="list-group-item">بذلك تكون قد أتممت عملية ارسال الأغنية بنجاح</li>
                  <li class="list-group-item">احتفظ بالرابط الذي سيصلك عبر رسالة نصية لاعادة ارسال الأغاني مجددا</li>
                </ul>
                        </div>
                        <div class="b-b m-y"></div>
                        <div class="nav text-sm _600"><a href="#" class="nav-link text-muted m-r-xs">Unsubscribe</a> <a href="#" class="nav-link text-muted m-r-xs">Policy</a>
                        </div>
                        <p class="text-muted text-xs p-b-lg">&copy; Copyright 2017</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal white lt fade" id="search-modal" data-backdrop="false"><a data-dismiss="modal" class="text-muted text-lg p-x modal-close-btn">&times;</a>
    <div class="row-col">
        <div class="p-a-lg h-v row-cell v-m">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="http://flatfull.com/themes/pulse/search.html" class="m-b-md">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Type keyword" data-ui-toggle-class="hide" data-ui-target="#search-result"> <span class="input-group-btn"><button class="btn b-a no-shadow white" type="submit">Search</button></span>
                        </div>
                    </form>
                    <div id="search-result" class="animated fadeIn">
                        <p class="m-b-md"><strong>23</strong> <span class="text-muted">Results found for:</span><strong>Keyword</strong>
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row item-list item-list-sm item-list-by m-b">
                                    <div class="col-xs-12">
                                        <div class="item r" data-id="item-5" data-src="http://streaming.radionomy.com/JamendoLounge">
                                            <div class="item-media">
                                                <a href=" " class="item-media-content" style="background-image: url('images/b4.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Live Radio</a>
                                                </div>
                                                <div class="item-author text-sm text-ellipsis"><a href=" " class="text-muted">Radionomy</a>
                                                </div>
                                                <div class="item-meta text-sm text-muted"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item r" data-id="item-2" data-src="http://api.soundcloud.com/tracks/259445397/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
                                            <div class="item-media">
                                                <a href=" " class="item-media-content" style="background-image: url('images/b1.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Fireworks</a>
                                                </div>
                                                <div class="item-author text-sm text-ellipsis"><a href=" " class="text-muted">Kygo</a>
                                                </div>
                                                <div class="item-meta text-sm text-muted"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item r" data-id="item-4" data-src="http://api.soundcloud.com/tracks/230791292/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
                                            <div class="item-media">
                                                <a href=" " class="item-media-content" style="background-image: url('images/b3.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">What A Time To Be Alive</a>
                                                </div>
                                                <div class="item-author text-sm text-ellipsis"><a href=" " class="text-muted">Judith Garcia</a>
                                                </div>
                                                <div class="item-meta text-sm text-muted"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item r" data-id="item-7" data-src="http://api.soundcloud.com/tracks/245566366/stream?client_id=a10d44d431ad52868f1bce6d36f5234c">
                                            <div class="item-media">
                                                <a href=" " class="item-media-content" style="background-image: url('images/b6.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Reflection (Deluxe)</a>
                                                </div>
                                                <div class="item-author text-sm text-ellipsis"><a href=" " class="text-muted">Fifth Harmony</a>
                                                </div>
                                                <div class="item-meta text-sm text-muted"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row item-list item-list-sm item-list-by m-b">
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="item-media rounded">
                                                <a href=" " class="item-media-content" style="background-image: url('images/a8.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Sara King</a>
                                                    <div class="text-sm text-muted">14 songs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="item-media rounded">
                                                <a href=" " class="item-media-content" style="background-image: url('images/a0.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Crystal Guerrero</a>
                                                    <div class="text-sm text-muted">12 songs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="item-media rounded">
                                                <a href=" " class="item-media-content" style="background-image: url('images/a5.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Judy Woods</a>
                                                    <div class="text-sm text-muted">23 songs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="item">
                                            <div class="item-media rounded">
                                                <a href=" " class="item-media-content" style="background-image: url('images/b0.jpg')"></a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-title text-ellipsis"><a href=" ">Jeremy Scott</a>
                                                    <div class="text-sm text-muted">14 songs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="top-search" class="btn-groups"><strong class="text-muted">Top searches:</strong> <a href="#" class="btn btn-xs white">Happy</a> <a href="#" class="btn btn-xs white">Music</a> <a href="#" class="btn btn-xs white">Weekend</a> <a href="#" class="btn btn-xs white">Summer</a> <a href="#" class="btn btn-xs white">Holiday</a> <a href="#" class="btn btn-xs white">Blue</a> <a href="#" class="btn btn-xs white">Soul</a> <a href="#" class="btn btn-xs white">Calm</a> <a href="#" class="btn btn-xs white">Nice</a> <a href="#" class="btn btn-xs white">Home</a> <a href="#" class="btn btn-xs white">SLeep</a>
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
<!-- Mirrored from flatfull.com/themes/pulse/  by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:53:51 GMT -->

</html>