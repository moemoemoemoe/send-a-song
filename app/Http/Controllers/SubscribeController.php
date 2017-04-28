<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Response;
use Session;
use App\Log;

use App\Helper;

use App\Video;
use app\Subscriber;

use Redirect;
use Transaction;
use App;

use Carbon\Carbon as Carbon;

use GuzzleHttp\Client as Guzz;


class SubscribeController extends Controller
{
	public static $dob_user = 'LibanCall';
    public static $dob_password = 'Lib@nC@ll@P@ssw0rd';
    public static $dob_merchant_id = 13;
    public static $dob_service_id = 11;

    public function new_subscriber_rec(Request $r){

            $status = -1;
            $data = [];
            $message = '';

            $phone_number = $r->input('phone_number');
            $country = 'lb';

            $check_phone_validity = Helper::check_phone_validity($phone_number, $country)->content();
            $check_phone_validity = json_decode($check_phone_validity, true);

            if($check_phone_validity['status'] == 1){
              $status = 1;


              $message = 'This number is Correct';

          }else if($check_phone_validity['status'] == 101){

            $status = 101;
            if($country == 'lb'){
                $message = 'Invalid mobile number';
            }else if($country == 'ir'){
                $message = 'Invalid number ir';
            }

        }else if($check_phone_validity['status'] == 100){

            $status = 100;
            if($country == 'lb'){
                $message = 'Please enter a valid mobile number';
            }else if($country == 'ir'){
                $message = 'Please enter a valid mobile number';
            }

        }

        return Response::json(['status' => $status, 'message' => $message, 'data' => $data]);

    }



public function new_subscriber(Request $r){

    $status = -1;
    $data = [];
    $message = '';

    $phone_number = $r->input('phone_number');
    $country = 'lb';

    $check_phone_validity = Helper::check_phone_validity($phone_number, $country)->content();
    $check_phone_validity = json_decode($check_phone_validity, true);

    if($check_phone_validity['status'] == 1){

        $unique_id = Helper::generate_unique_id($check_phone_validity['phone_number']);
        $new_subscriber_request = Helper::new_subscriber($unique_id, $check_phone_validity['phone_number'], $check_phone_validity['operator'], $check_phone_validity['country'])->content();

        $new_subscriber_request = json_decode($new_subscriber_request, true);

            //$data = $new_subscriber_request;

        if($new_subscriber_request['status'] == 1){
            $basket = $new_subscriber_request['basket'];
            $status = 1;
            $subscriber_id = $new_subscriber_request['subscriber_id'];
          $query =  app\Subscriber::where('id' , $subscriber_id )->firstOrFail();
           $uidprof = $query->uid;

            Session::put('subscriber_id' , $subscriber_id);
            $data = ['operator' => $check_phone_validity['operator']];
        }else if($new_subscriber_request['status'] == 203){
            $basket = $new_subscriber_request['basket'];
            $status = 203;
            $message = $new_subscriber_request['message'];
            $subscriber_id = $new_subscriber_request['subscriber_id'];
          $query =  app\Subscriber::where('id' , $subscriber_id )->firstOrFail();
$uidprof = $query->uid;
        }else{
            $basket = $new_subscriber_request['basket'];
            $status = -1;
           $subscriber_id = $new_subscriber_request['subscriber_id'];
          $query =  app\Subscriber::where('id' , $subscriber_id )->firstOrFail();
$uidprof = $query->uid;
            $message = 'Something went wrong';
        }


    }else if($check_phone_validity['status'] == 101){
        $uidprof = 0;
        $basket = 0;
        $status = 101;
        if($country == 'lb'){
            $message = 'Invalid mobile number';
        }else if($country == 'ir'){
            $message = 'Invalid number ir';
        }

    }else if($check_phone_validity['status'] == 100){
        $basket = 0;
        $uidprof = 0;
        $status = 100;
        if($country == 'lb'){
            $message = 'Please enter a valid mobile number';
        }else if($country == 'ir'){
            $message = 'Please enter a valid mobile number';
        }

    }

    return Response::json(['status' => $status, 'message' => $message,'basket' => $basket,'uidz' => $uidprof,'data' => $data]);

}




public function check_pin_code(Request $r){

    $status = -1;
    $message = '';
    $data = [];

    $pin_code = $r->input('pin_code');
    $subscriber_id = Session::get('subscriber_id');
        //return $subscriber_id;
    $country = 'lb';

    $check_pin_validity = Helper::check_pin_code($pin_code, $subscriber_id, $country);

    $check_pin_validity_json = $check_pin_validity->content();
    $check_pin_validity_json = json_decode($check_pin_validity_json, true);
    if($check_pin_validity_json['status'] == 1){
        $subscriber = Subscriber::findOrFail($subscriber_id);
            // send sms


             $message_sent = "Please find and save your link below: \n http://localhost/sass/public/profile/".$subscriber->uid;
            
            
            $client = new Guzz();
            $response = $client->request('POST', 'http://smsapi.libancallplus.com/api/massage', [
                'json' => [
                'username' => 'sendsong',
                'password' => 's3nb@50nG@790',
                'code' => 'Send a song',
                'phone' => $subscriber->phone_number,
                'massage' => $message_sent,
                'lang' => 1
                ]

                ]);

            }

            return $check_pin_validity;

        }

public function send_song(Request $r){
    $phone_number = $r->input('phone');
    $phone_number_rec = $r->input('phonerec');
    //$songcode = $r->input('songcode');
    $subscriber_ids = Session::get('uniqueidi');
    $sub = app\Subscriber::where('id', $subscriber_ids)->firstOrFail();
    $uniqid_profile = $sub->uid; 
    $data = [];
    $client = new Guzz();
    $response = $client->request('POST', 'http://sas.libancallplus.com/api/apSendSong', [
        'query' => [
        'code' => '10016581',
        'fromMobile' => $phone_number,
        'toMobile' => $phone_number_rec,
        'dateout' => date('Ymd'),
        'timeout' => date('His')
        ]
        ]
        );
    $body = $response->getBody();
    $body = json_decode($body, true);
    if($body['RespVal'] == 1)
    {
         $uniqid_profile = $sub->uid ; 
        $status = 1 ;
        $message = $body['RespMsg'] ; 

              $log = new Log();
                $log->subscriber_id = $subscriber_ids;
                $log->subscriber_phone_number = $phone_number;
                $log->receiver_phone_number = $phone_number_rec;
                $log->tone_code = '10015830';
                $log->status_code = 1;
                $log->transaction_type = 1;
                $log->date_of_operation = date('Y-m-d');
                $log->time_of_operation = date('H:i:s');
                $log->save();
 
 $response = $client->request('POST', 'http://smsapi.libancallplus.com/api/massage', [
                                    'json' => [
                                    'username' => 'sendsong',
                                    'password' => 's3nb@50nG@790',
                                    'code' => 'Send a song',
                                    'phone' => $phone_number_rec,
                                    'massage' => "من مين هالغنية؟ عرفت، رد بسرية. اضغط على الرابط\nhttp://localhost/sass/public/",
                                    'date' => date('Y-m-d H:i:s', strtotime('+7minutes')),
                                    'isleb' => 1,
                                    'lang' => 1
                                    ]

                                    ]);

        $subscriber = app\Subscriber::findOrFail($subscriber_ids);
        $subscriber->basket -= 1;
        $subscriber->save();   
    }else
    {
         $uniqid_profile = 0; 
        $status = -1 ;
        $message = $body['RespMsg'] ;  
          $log = new Log();
                $log->subscriber_id = $subscriber_ids;
                $log->subscriber_phone_number = $phone_number;
                $log->receiver_phone_number = $phone_number_rec;
                $log->tone_code = '10016613';
                $log->status_code = -1;
                $log->transaction_type = 1;
                $log->date_of_operation = date('Y-m-d');
                $log->time_of_operation = date('H:i:s');
                $log->save();
    }
    return Response::json(['status' => $status,'message' => $message ,'uid' => $uniqid_profile ,'data' => $data]);
               // return $body;
}








public function new_one_time_payment(Request $r){
     $data = [];
 $uid =  Session::get('uniqueidi');
$phone_number = $r->input('phone_number');
//$subscriber = app\Subscriber::where('id', $uid)->firstOrFail();

 $uniqueid = Helper::generate_unique_id($phone_number);
  //Session::put('onetimeuniq', $uniqueid);
   $request = new Guzz();


            $url = 'https://testdobapi.libancallplus.com/newrequest';

         
            $res = $request->request('POST', $url, [
                
                'headers' => [
                'user' => self::$dob_user,
                'password' => self::$dob_password,
                'merchantid' => self::$dob_merchant_id
                ],
                'query' => [
                'uniqueid' => $uniqueid,
                'serviceid' => '10',
                'msisdn' => $phone_number,
                'valid' => 0
                ]
                ]);

            $body = $res->getBody();
             $body = json_decode($body, true);
           
            if($body['Response'] == 1){
              $subscriber = app\Subscriber::findOrFail($uid);
             $subscriber->is_self = 1; 
             $subscriber->transaction_id_self = $body['Data']['TransactionID'];
             $subscriber->uid_self = $uniqueid;
             $subscriber->save();

                $status = 1;
                $message = 'Success';


            }else{ 
             $status = -1;
                     
           $message = 'لا يمكنك الاشترلك حاليا، حاول مرة اخرى';
                                    }

        return Response::json(['status' => $status, 'message' => $message, 'data' => $data]);


}











public function check_pin_code_one_time(Request $r){
 $data = [];
 $uid =  Session::get('uniqueidi');
$pin_code = $r->input('pin_code');
$phone_number = $r->input('phone_number');

$subscriber = app\Subscriber::where('id', $uid)->firstOrFail();
$uniqueid = $subscriber->uid_self;
// $uniqueid = Helper::generate_unique_id($phone_number);
//return $pin_code;

   $request = new Guzz();
//$country = 'lb';

            $url = 'https://testdobapi.libancallplus.com/confirm';

        if(strlen($pin_code) > 0){

                            $client = new Guzz();
                            $response = $client->request('POST', $url, [
                                'verify' => false,
                                'headers' => [
                                 'user' => self::$dob_user,
                                 'password' => self::$dob_password,
                                 'merchantid' => self::$dob_merchant_id
                                ],
                                'query' => [
                                'uniqueid' => $uniqueid,
                                'serviceid' => '10',
                                'msisdn' => $phone_number,
                                'PIN' => $pin_code,
                                'TransactionID' => $subscriber->transaction_id_self
                                ]
                                ]);

                            $body = $response->getBody();
                            $body = json_decode($body, true);
                             //return $body;
                            if($body['Response'] == 1){
                                $subscriber->is_self = 1;
                             
                                $subscriber->save();

                                if($body['Data']['Result'] == 1){

                    

                        // new transaction

                                    $trns = new app\Transaction();
                                    $trns->subscriber_id = $uid;
                                    $trns->subscriber_phone = $phone_number;
                                    $trns->unique_id = $uniqueid;
                                    $trns->transaction_id = $subscriber->transaction_id_self;
                                    $trns->transaction_status = $body['Data']['Result'] == 1;
                                    $trns->transaction_type = 2;
                                    $trns->billing_date = date('Y-m-d');
                                    $trns->end_subscription_date = date('Y-m-d');
                                    $trns->date_of_transaction = date('Y-m-d');
                                    $trns->time_of_transaction = date('H:i:s');
                                    $trns->save();

                                    $status = 1;
                                    $data = ['from' => $subscriber->phone_number];
                                    $message = 'تم ارسال الاغنية بنجاح';


                }else{ // end if body data result == 1
                    $status = -2;
                    $data = (object)[];
                    $message = 'ليس لديك الرصيد الكافي، الرجاء إعادة التعبئة والمحاولة لاحقاً.';
                }

            }else{ // end if body response == 1
                $status = -1;
                $data = (object)[];
                $message = 'الرجاء التحقق من الرمز السري';
            }

        }else{//end if strlen pin > 0
            $status = -1;
            $data = (object)[];
            $message = 'الرجاء التحقق من الرمز السري';
        }

        return Response::json(['status' => $status, 'data' => $data, 'message' => $message]);
}

}
