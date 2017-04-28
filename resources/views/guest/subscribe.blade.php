<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from flatfull.com/themes/pulse/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:55:12 GMT -->

<head>
    <meta charset="utf-8">
    <title>SendASong | Subscribe</title>
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

</head>

<body>
    <div class="app dk" id="app">
        <div class="padding">
            <div class="navbar">
                <div class="pull-center">
                    <a href="index.html" class="navbar-brand md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="32" height="32">
                            <circle cx="24" cy="24" r="24" fill="rgba(255,255,255,0.2)" />
                            <circle cx="24" cy="24" r="22" fill="#1c202b" class="brand-color" />
                            <circle cx="24" cy="24" r="10" fill="#ffffff" />
                            <circle cx="13" cy="13" r="2" fill="#ffffff" class="brand-animate" />
                            <path d="M 14 24 L 24 24 L 14 44 Z" fill="#FFFFFF" />
                            <circle cx="24" cy="24" r="3" fill="#000000" />
                        </svg> <img src="images/logo.png" alt="." class="hide"> <span class="hidden-folded inline">Send a Song</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="b-t">
            <div class="center-block w-xxl w-auto-xs p-y-md text-center">
                <div class="p-a-md" id="enter_phone_form">
                    <div>
                        <h4>Subscribe</h4>
                        <p class="text-muted m-y">Enter your phone number below and we will send you a pin code verification.</p>
                    </div>
                   
                        <div class="form-group">
                        <input type="text"  class="form-control" placeholder="961" disabled style="text-align: center;" />
                            <input type="tel" id="phone_number" placeholder="Enter your mobile number" class="form-control" required style="text-align: center">
                        </div>
                        <button id="btn_phone"  class="btn  btn-block p-x-md" style="background-color: #5cb85c ; color: #fff" onclick="check_phone_number()">Subscribe</button>
                   <span  id="response" style="text-align: center"></span>
                   
                </div>
                 <div class="p-a-md panel" id="resp"  style="display: none;">
                    <div >
                        <h4>Subscribe</h4>
                        <p class="text-muted m-y" id="success"></p>
                    </div>
                   
                        
                       
                </div>
                  

                 <div class="p-a-md" style="display: none" id="enter_pin_form">
                    <div>
                        <h4>Subscribe</h4>
                        <p class="text-muted m-y">Enter the 4 digits pin code below </p>
                    </div>
                   
                        <div class="form-group">
                            <input type="tel" id="pin_code" placeholder="Enter pin code" class="form-control" required style="text-align: center">
                        </div>
                        <button id="btn_pin"  class="btn  btn-block p-x-md" style="background-color: #5cb85c ; color: #fff" onclick="show_confirm_modal()">Check</button>
                   
                   
                </div>
                <div class="p-a-md panel" id="pinc" style="display: none;">
                    <div >
                        <h4>Subscribe</h4>
                        <p class="text-muted m-y" id="reso"></p>
                    </div>
                   
                        
                       
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade large_bootbox" id="modal-confirm-operator-message" tabindex="-1" role="dialog" style="z-index: 999999999">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          <h4 class="modal-title">

          </h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-4" id="operator_logo">

            </div>
            <div class="col-md-9 col-sm-8 col-xs-8">
              You are about to subscribe to "Foodoo" for 1.5 USD/week through your <span id="op_name"></span> account and it will be automatically renewed every week.
              Click continue to proceed.
            </div>
          </div>
        </div>

        <!-- Modal Actions -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-success" onclick="check_pin_code()" id="confirm_btn">Continue</button>
        </div>
      </div>
    </div>
  </div>
<script src="{{asset('scripts/app.min.js')}}"></script>



 <script type="text/javascript">

    function check_phone_number(){
       
      $('#btn_phone').attr('onclick', '');
      $('#btn_phone').html('please wait ...');
      var phone_number = $('#phone_number').val();
      $.ajax({
        url: '{{ route('new_subscriber') }}',
        type: 'POST',
        data:{
          _token: '{{ csrf_token() }}',
          phone_number: phone_number
        },
        cache: false,
        datatype: 'JSON',
        success: function(data){
          $('#btn_phone').attr('onclick', 'check_phone_number()');
          $('#btn_phone').html('Continue');
          if(data.status == 1){
          $('#response').html('');
          // $('#header').hide();
            $('#heade').hide();

        

            $('#enter_phone_form').hide();
            $('#enter_pin_form').fadeIn();

            var operator_logo = '';
            if(data.data.operator == 'Alfa'){
              operator_logo += '<img src="http://foodoo.mobi/images/alfa_logo_final.png" style="width:100%; border-radius: 3px"/>';
                         $('#op_name').html('alfa');
            
            }else if(data.data.operator == 'Touch'){
              operator_logo += '<img src="http://foodoo.mobi/images/touch_logo_final.png" style="width:100%; border-radius: 3px"/>';
              $('#op_name').html('touch');
            }
            $('#operator_logo').html(operator_logo);

          }else if(data.status == 101){
                       $('#heade').hide();

            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }else if(data.status == 100){
                       $('#heade').hide();

            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }else if(data.status == 203){
                  
$('#resp').fadeIn();
if(data.basket > 0)
{
            $('#success').html(data.message);
        }
        else{ $('#success').html('you are all ready subscribed and your basket is empty');}
             $('#enter_phone_form').hide();
             

  
             setTimeout(function(){
              window.location.replace('http://localhost/websong/public/profile/'+data.uidz);
            }, 3000);
          }
        },
        error: function(){
                     $('#heade').hide();

          $('#btn_phone').attr('onclick', 'check_phone_number()');
          $('#btn_phone').html('try again');
        }
      });
    }

    function show_confirm_modal(){
      $('#modal-confirm-operator-message').modal('show');
    }

   
    function check_pin_code(){
       
      $('#modal-confirm-operator-message').modal('hide');
      $('#btn_pin').attr('onclick', '');
      $('#btn_pin').html('please wait ...');
      var pin_code = $('#pin_code').val();
      $.ajax({
        url: '{{ route('check_pin_code') }}',
        type: 'POST',
        data:{
          _token: '{{ csrf_token() }}',
          pin_code: pin_code
        },
        cache: false,
        datatype: 'JSON',
        success: function(data){
          $('#btn_pin').attr('onclick', 'show_confirm_modal()');
          $('#btn_pin').html('Continue');
          if(data.status == 1){
            $('#response').html('');

            $('#success_form').fadeIn();
            $('#enter_pin_form').hide();
             $('#pinc').fadeIn();
             $('#reso').html('You have successfuly subscribed to the service')

            $('#operator_touch').hide();
            $('#operator_alfa').hide();
  
            setTimeout(function(){
              window.location.replace('http://localhost/websong/public/profile/'+data.theuid);
            }, 2000);
            
          }else if(data.status == 300){
            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }else if(data.status == 301){
            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }else if(data.status == 302){
            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }else{
            $('#response').html('<div class="text-warning">'+data.message+'</div>');
          }
        },
        error: function(){
          $('#btn_pin').attr('onclick', 'show_confirm_modal()');
          $('#btn_pin').html('try again');
        }
      });
    }
  

  </script>
  </script>






</body>
<!-- Mirrored from flatfull.com/themes/pulse/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Apr 2017 06:55:12 GMT -->

</html>