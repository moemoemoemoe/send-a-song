
<script type="text/javascript"> 
 
	
	var songcode;
	var phone_rec;
	var phonenumber;

	
	function modal_form_send(song_code){
		var uid = $("#uid_pro").val();
		//window.alert(uid);
		songcode = song_code;
		phonenumber = uid;
		$('#test').html(songcode);
		$('#song_name').html('You have choose '+songcode+'  to send ')
		$('#modal-send-rec').modal('show');

	}
function search()
{
var key = $('#keyword').val();

	window.location.replace('http://localhost/websong/public/search/'+key);
}
function search_a()
{
var key = $('#keyworda').val();

	window.location.replace('http://localhost/websong/public/search/'+key);
}
	function check_phone_number_rec()
	{
		$('#confirm_btn_one').attr('onclick', '');
		$('#confirm_btn_one').html('please wait ...');
		phone_rec = $('#phone_number_rec').val();
		var phone_number = $('#phone_number_rec').val();
		$.ajax({
			url: '{{ route('new_subscriber_rec') }}',
			type: 'POST',
			data:{
				_token: '{{ csrf_token() }}',
				phone_number: phone_rec
			},
			cache: false,
			datatype: 'JSON',
			success: function(data){
				$('#confirm_btn_one').attr('onclick', 'check_phone_number_rec()');
				$('#confirm_btn_one').html('Continue');
				if(data.status == 1){
					$('#response').html('');
					$('#title').html('this you mobile number..press continue to send the song');
					$('#step_one').hide();
					$('#step_one_button').hide();
					$('#step_two').fadeIn();
					$('#step_two_button').fadeIn();
$('#zip').hide();

				}else if(data.status == 101){
                       // window.alert(data.message);

                       $('#response').html('<div  style="color :red">'+data.message+'</div>');
                   }else if(data.status == 100){

                   	$('#response').html('<div  style="color :red">'+data.message+'</div>');
                   }
               },
               error: function(){

               	$('#confirm_btn_one').attr('onclick', 'check_phone_number_rec()');
               	$('#confirm_btn_one').html('try again');
               }
           });

	}

	function check_phone_number(){

		$('#confirm_btn_two').attr('onclick', '');
		$('#confirm_btn_two').html('please wait ...');
		//phonenumber= $('#phone_number').val();
		var phone_number = $('#phone_number').val();
		$.ajax({
			url: '{{ route('new_subscriber') }}',
			type: 'POST',
			data:{
				_token: '{{ csrf_token() }}',
				phone_number: phonenumber
			},
			cache: false,
			datatype: 'JSON',
			success: function(data){
				$('#confirm_btn_two').attr('onclick', 'check_phone_number()');
				$('#confirm_btn_two').html('Continue');
				if(data.status == 1){
					$('#response-user').html('');
					$('#title').html('أدخل رقم السري الذي وصلك في الرسالة النصية..');
					$('#zip').hide();
					$('#step_two').hide();
					$('#step_two_button').hide();
					$('#step_three').fadeIn();
					$('#step_three_button').fadeIn();
					$('#op_text').fadeIn();

					var operator_logo = '';
					if(data.data.operator == 'Alfa'){
						operator_logo += '<img src="http://localhost/sass/public/images/alfa_logo_x_small.png" style="width:100%; border-radius: 3px"/>';
						$('#op_name').html('alfa');

					}else if(data.data.operator == 'Touch'){
						operator_logo += '<img src="http://localhost/sass/public/images/touch_logo_x_small.png" style="width:100%; border-radius: 3px"/>';
						$('#op_name').html('touch');
					}
					$('#operator_logo').html(operator_logo);

				}else if(data.status == 101){
					$('#heade').hide();

					$('#response-user').html('<div style="color :red">'+data.message+'</div>');
				}else if(data.status == 100){
					$('#response-user').html('<div  style="color :red">'+data.message+'</div>');
				}else if(data.status == 203){

					if(data.basket > 0)
					{

						$('#zip').hide();
						$('#step_two').hide();
						$('#step_two_button').hide();
						$('#sendsong_one').fadeIn();
						$('#response-pin').html('Are you sure you want to send'+songcode);
						$('#title').hide();
						$('#span').html(data.message);



					}
					else{
						$('#zip').hide();
						$('#step_two').hide();
						$('#step_two_button').hide();
						$('#request_pin_button').fadeIn();
						$('#title').hide();
						//$('#enter_phone_form').hide();
						$('#span').html('One Time Payment...you have reached the 3 songs click ok to request pin code '+phonenumber);
						//$('#one_time_payment_form').fadeIn();
             // $('#modal-send-one-time').modal('show');
         }
     }
 },
 error: function(){
                    // $('#heade').hide();

                    $('#confirm_btn_two').attr('onclick', 'check_phone_number()');
                    $('#confirm_btn_two').html('try again');
                }
            });
	}



	function check_pin_code(){


		$('#confirm_btn_three').attr('onclick', '');
		$('#confirm_btn_three').html('please wait ...');
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
				$('#confirm_btn_three').attr('onclick', 'check_pin_code()');
				$('#confirm_btn_three').html('Continue');
				if(data.status == 1){
			$('#response-pin').html('Are you sure you want to send  '+songcode);

           // $('#success_form').fadeIn();
           $('#operator_logo').hide();
           //  $('#pinc').hide();

           $('#step_three_button').hide();
           $('#step_three').hide();
           $('#op_text').hide();
           $('#sendsong_one').fadeIn();



       }else if(data.status == 300){
       	$('#response-pin').html('<div  style="color :red">'+data.message+'</div>');
       }else if(data.status == 301){
       	$('#response-pin').html('<div  style="color :red">'+data.message+'</div>');
       }else if(data.status == 302){
       	$('#response-pin').html('<div  style="color :red">'+data.message+'</div>');
       }else{
       	$('#response-pin').html('<div  style="color :red">'+data.message+'</div>');
       }
   },
   error: function(){
   	$('#confirm_btn_three').attr('onclick', 'check_pin_code()');
   	$('#confirm_btn_three').html('try again');
   }
});
	}



	function send_song(){

		$.ajax({
			url: '{{ route('sendthissong') }}',
			type: 'POST',
			data:{
				_token: '{{ csrf_token() }}',
				phone: phonenumber,
				phonerec: phone_rec,
				songcode: songcode
			},
			cache: false,
			datatype: 'JSON',
			success: function(data){
				$('#agree').attr('onclick', 'send_song()');
				$('#agree').html('Continue');
				if(data.status == 1){
					$('#response-pin').hide();
					$('#ytitle').hide();
					$('#success').html('this song is sent Successfully');

            //$('#modal-send-one-time').modal('hide');
            
            setTimeout(function(){

            	$('#modal-send-rec').modal('hide');
            	window.location.replace('http://localhost/websong/public/profile/'+data.uid);
            }, 4000);
            


        }else{

$('#response-pin').hide();
        	$('#success').html('unSuccessfully please try again later'); 
        	setTimeout(function(){
        		$('#modal-send-rec').modal('hide');
        		window.location.replace('http://localhost/websong/public');
        	}, 4000);

        }
    },
    error: function(){


    	$('#success').html('somthing went  wrong');
    	$('#agree').attr('onclick', 'send_song()');
    	$('#agree').html('try again');

    }
}); 
	}



	 function one_time_payment_req(){

    $('#btn_req').attr('onclick', '');
    $('#btn_req').html('please wait ...');

    $.ajax({
      url: '{{ route('new_one_time_payment') }}',
      type: 'POST',
      data:{
        _token: '{{ csrf_token() }}',
        phone_number: phonenumber
      },
      cache: false,
      datatype: 'JSON',
      success: function(data){
        $('#btn_req').attr('onclick', 'one_time_payment_req()');
        $('#btn_req').html('Continue');
        if(data.status == 1){
$('#response-pin').html('A pin code is sent to  '+phonenumber);
 $('#request_pin_button').hide();
$('#span').hide();
         $('#pin_code_verification_form').fadeIn();
         $('#pin_code_verification_form_button').fadeIn();

         
  //////$('#sendsong_one').fadeIn();
            // $('#modal-send-one-time').modal('show');


        }else {

$('#span').hide();
$('#sendsong_one').html(data.message);
        }

      
    },
    error: function(){
                    

                    $('#btn_req').attr('onclick', 'one_time_payment_req()');
                    $('#btn_req').html('try again');
                  }
                });
  }



   function check_pin_code_one_time(){

    $('#confirm_btn_one_time').attr('onclick', '');
    $('#confirm_btn_one_time').html('please wait ...');
     var pin_code = $('#pin_code_one_time').val();
    // var phone_number = ph;
    $.ajax({
      url: '{{ route('check_pin_code_one_time') }}',
      type: 'POST',
      data:{
        _token: '{{ csrf_token() }}',
        pin_code: pin_code,
        phone_number: phonenumber
      },
      cache: false,
      datatype: 'JSON',
      success: function(data){
        $('#confirm_btn_one_time').attr('onclick', 'check_pin_code_one_time()');
        $('#confirm_btn_one_time').html('Continue');
        if(data.status == 1){
        	 $('#response-pin').hide();
        	
          $('#ytitle').html('Success!! ');
          setTimeout(function(){
              send_song();
            }, 2000);
          
           

        }else {
        	 $('#response-pin').html('Unsuccess!! please enter valid pin code');
$('#span').hide;

           // send_song();
        }

      
    },
    error: function(){
                    // $('#heade').hide();

                    $('#confirm_btn_one_time').attr('onclick', 'check_pin_code_one_time()');
                    $('#confirm_btn_one_time').html('try again');
                  }
                });
  }

</script>
