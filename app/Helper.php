<?php

namespace App;

use App\Visitor;
use App\Subscriber;

use GuzzleHttp\Client as Guzz;

use Response;
use Session;

use App;

class Helper{

	public static $dob_user = 'LibanCall';
	public static $dob_password = 'Lib@nC@ll@P@ssw0rd';
	public static $dob_merchant_id = 13;
	public static $dob_service_id = 11;

	

	public static function visitor($page_name, $ref){

		$v = new Visitor();
		$v->page_name = $page_name;
		$v->ref = $ref;
		$v->save();	

		$diff = strtotime(date('Y-m-d 23:59:00')) - strtotime(date('Y-m-d H:i:s'));

		setcookie("visitor_id",$v->id,time()+$diff);

		return $v->id;

	}
	public static function check_phone_validity($phone_number, $country){

		$status = -1;
		$operator = '';

		if(strlen($phone_number) != 0){

			$request = new Guzz();
			if($country == 'lb'){
				$res = $request->request('GET', 'https://mobilevalidator.libancallplus.com/mobileNumber/'.$phone_number);
			}else if($country == 'ir'){
				$res = $request->request('GET', 'http://valid.verabehinarman.com/mobileNumber/'.$phone_number);
			}

			$response = $res->getBody();
			$response = json_decode($response, true);

			if($response['Ok'] == true){

				$status = 1;
				$operator = '';
				$phone_number = $response['MSISDN'];

				if($country == 'lb'){
					if($response['Operator'] == 1){
						$operator = 'Alfa';
					}else if($response['Operator'] == 2){
						$operator = 'Touch';
					}else{
						$operator = 'Unknown LB';
					}
				}else if($country == 'ir'){
					if($response['Operator'] == 1){
						$operator = 'MCI';
					}else{
						$operator = 'Unknown IR';
					}
				}

			}else{
				$status = 101; // invalid phone number
			}

			return Response::json(['status' => $status, 'country' => $country, 'operator' => $operator, 'phone_number' => $phone_number]);

		}else{
			$status = 100; // please enter phone number
			return Response::json(['status' => $status]);
		}
	}

	public static function new_subscriber($unique_id, $phone_number, $operator, $country){

		$ref = 'Home';
		if(\Request::has('ref')){
			$ref = \Request::input('ref');
		}

		$status = -1;
		$message = '';
		$data = [];

		// check if phone number have active subscription
		$search_for_an_active_subscription = app\Subscriber::where('phone_number', $phone_number)->whereDate('end_sub_date', '>', date('Y/m/d'))->count();

		if($search_for_an_active_subscription == 1){
			$an_active_subscription = app\Subscriber::where('phone_number', $phone_number)->whereDate('end_sub_date', '>', date('Y/m/d'))->firstOrFail();

			Session::put('uniqueidi' , $an_active_subscription->id);
              
		  $originalDate = $an_active_subscription->end_sub_date;
           $newDatee = date("d-m-Y", strtotime($originalDate));
			$status = 203;
			$basket = $an_active_subscription->basket;
			//$message = 'Already subscribed contact us to get your profile link';
			$message = 'Your weekly subscription period will be active till  '.$newDatee;
			$message .= '<br />And Your basket is  '.$an_active_subscription->basket;
			$subscriber_id = $an_active_subscription->id;
		}else{

			$request = new Guzz();

			$url = 'https://testdobapi.libancallplus.com/newrequest';

			if($country == 'ir'){
				$url = 'https://dobapi.verabehinarman.com/newrequest';
			}

			$res = $request->request('POST', $url, [
				
				'headers' => [
				'user' => self::$dob_user,
				'password' => self::$dob_password,
				'merchantid' => self::$dob_merchant_id
				],
				'query' => [
				'uniqueid' => $unique_id,
				'serviceid' => self::$dob_service_id,
				'msisdn' => $phone_number,
				'valid' => 2
				]
				]);

			$response = $res->getBody();
			$response = json_decode($response, true);

			if($response['Response'] == 1){
				$transaction_id = $response['Data']['TransactionID'];

				$subscriber = new Subscriber();
				$subscriber->visitor_id = 1;
				$subscriber->uid = $unique_id;
				$subscriber->phone_number = $phone_number;
				$subscriber->operator = $operator;
				$subscriber->status = 0;
				$subscriber->basket = 3;
				$subscriber->transaction_id = $transaction_id;
				$subscriber->end_sub_date = date('Y/m/d');
				$subscriber->ref = $ref;
				$subscriber->dob_response = 'New Request: '.$res->getBody();
				$subscriber->save();

				$subscriber_id = $subscriber->id;
				Session::put('uniqueidi' , $subscriber->id);

				$status = 1;
				$message = 'success';
				$basket = 3;

			}else if($response['Response'] == 12){

				$subscriber_id = 0;
			$status = 200; // invalid merchant, user or password
			$message = 'invalid merchant, user or password';
			$basket = 3;

		}else if($response['Response'] == 14){

			$subscriber_id = 0;
			$status = 201; // duplicated uid
			$message = 'duplicated uid';
			$basket = 3;

		}else if($response['Response'] == 15){

			$subscriber_id = 0;
			$status = 202; // invalid phone number
			$message = 'invalid mobile number';
			$basket = 3;

		}else{

			$subscriber_id = 0;
			$status = 999; // unknown error
			$message = 'unknown error';
			$basket = 3;

		}

	}

	//$data = $search_for_an_active_subscription;

	return Response::json(['status' => $status, 'message' => $message, 'subscriber_id' => $subscriber_id,'basket' => $basket, 'data' => $data]);

}

public static function check_pin_code($pin_code, $subscriber_id, $country){

	$status = -1;
	$message = '';
	$data = [];

	$url = 'https://testdobapi.libancallplus.com/confirm';
	if($country == 'ir'){
		$url = 'https://dobapi.verabehinarman.com/confirm';
	}

	$subscriber = Subscriber::findOrFail($subscriber_id);
	$subscriber->status = 2;
	$subscriber->save();
$theuid = $subscriber->uid;
	$request = new Guzz();
	$res = $request->request('POST', $url, [
		'headers' => [
		'user' => self::$dob_user,
		'password' => self::$dob_password,
		'merchantid' => self::$dob_merchant_id
		],
		'query' => [
		'uniqueid' => $subscriber->uid,
		'serviceid' => self::$dob_service_id,
		'msisdn' => $subscriber->phone_number,
		'PIN' => $pin_code,
		'TransactionID' => $subscriber->transaction_id
		]
		]);

	$response = $res->getBody();
	$response = json_decode($response, true);

	$subscriber->dob_response .= '<br />Check pin: '.$res->getBody();
	$subscriber->save();
//return $response['Response'];
	if($response['Response'] == 1){

		if($response['Data']['Result'] == 1){
				$subscriber->status = 1; // success
				$subscriber->end_sub_date = date('Y/m/d', strtotime('+7days'));
				$subscriber->basket = 3 ;
				$subscriber->save();
$uidz = $theuid;
				$status = 1;
				$message = 'Success';
				$data = ['subscriber_uid' => $subscriber->uid];
			}else if($response['Data']['Result'] == 0){
				$subscriber->status = 3; // no money or ...
				$subscriber->save();
				$status = 301;
				$uidz = $theuid;
				//$message = 'No money or line expired or coorporate number or blocked number';
				$message = 'You do not have enough credits to subscribe to this service';
			}else{
				$uidz = 0;
				$status = 999; // unknown error
				$message = 'unknown error';
			}

		}else if($response['Response'] == 12){
			$uidz = 0;
			$status = 200; // invalid merchant, user or password
			$message = 'invalid merchant, user or password';
		}else if($response['Response'] == 13){
			$uidz = 0;
			$status = 300; // invalid pin code
			$message = 'In-correct PIN';
		}else{
			$uidz = 0;
			$status = 302;
			$message = 'Please enter pin code';
		}

		return Response::json(['status' => $status, 'data' => $data, 'message' => $message , 'theuid' => $uidz]);

	}

	public static function generate_unique_id($phone_number){
		return $phone_number.'-'.date('YmdHis').'-'.mt_rand(11111,99999);
	}

	public static function check_subscription($subscriber_id, $country){
		$status = -1;
		$message = '';
		$end_date = '';

		$url = 'https://testdobapi.libancallplus.com/check';
		if($country == 'ir'){
			$url = 'https://dobapi.verabehinarman.com/check';
		}

		$subscriber = Subscriber::findOrFail($subscriber_id);

		$request = new Guzz();
		$res = $request->request('POST', $url, [
			'headers' => [
			'user' => self::$dob_user,
			'password' => self::$dob_password,
			'merchantid' => self::$dob_merchant_id
			],
			'query' => [
			'uniqueid' => $subscriber->uid,
			'serviceid' => self::$dob_service_id,
			'msisdn' => $subscriber->phone_number,
			'TransactionID' => $subscriber->transaction_id
			]
			]);

		$response = $res->getBody();
		$response = json_decode($response, true);

		if($response['Response'] == 1){
			if($response['Data']['Result'] == 1){
				$status = 500;
				$message = 'in subscription period';
				$end_date = $response['Data']['EndDate'];
			}else if($response['Data']['Result'] == 2){
				$status = 501;
				$message = 'in grace period';
				$end_date = $response['Data']['EndDate'];
			}else if($response['Data']['Result'] == 0){
				$status = 502;
				$message = 'under processing';
				$end_date = $response['Data']['EndDate'];
			}else if($response['Data']['Result'] == 3){
				$status = 503;
				$message = 'unsubscribed';
				$end_date = $response['Data']['EndDate'];
			}else if($response['Data']['Result'] == 4){
				$status = 504;
				$message = 'failed to subscribe';
				$end_date = $response['Data']['EndDate'];
			}

			$end_date = \Carbon\Carbon::parse($end_date)->format('Y/m/d');

		}else{
			$status = 999;
			$message = 'unknown error';
		}

		return Response::json(['status' => $status, 'message' => $message, 'end_date' => $end_date]);

	}

	public static function remove_subscriber($subscriber_id, $country){

		$status = -1;
		$message = '';

		$subscriber = Subscriber::findOrFail($subscriber_id);

		$url = 'https://testdobapi.libancallplus.com/unsub';
		if($country == 'ir'){
			$url = 'https://dobapi.verabehinarman.com/unsub';
		}

		$request = new Guzz();
		$res = $request->request('POST', $url, [
			'headers' => [
			'user' => self::$dob_user,
			'password' => self::$dob_password,
			'merchantid' => self::$dob_merchant_id
			],
			'query' => [
			'serviceid' => self::$dob_service_id,
			'msisdn' => $subscriber->phone_number,
			'TransactionID' => $subscriber->transaction_id
			]
			]);

		$response = $res->getBody();
		$response = json_decode($response, true);

		$subscriber->dob_response .= '<br />Remove request: '.$res->getBody();
		$subscriber->save();

		if($response['Response'] == 1){
			$status = 1;
			$message = 'success, enter pin to continue';
		}else if($response['Response'] == 13){
			$status = 600;
			$message = 'negative submit';
		}else{
			$status = 999;
			$message = 'unknown error';
		}

		return Response::json(['status' => $status, 'message' => $message]);

	}

	public static function check_pin_code_unsub($pin_code, $subscriber_id, $country){
		$status = -1;
		$message = '';

		$url = 'https://testdobapi.libancallplus.com/unsubconfirm';
		if($country == 'ir'){
			$url = 'https://dobapi.verabehinarman.com/unsubconfirm';
		}

		$subscriber = Subscriber::findOrFail($subscriber_id);

		$request = new Guzz();
		$res = $request->request('POST', $url, [
			'headers' => [
			'user' => self::$dob_user,
			'password' => self::$dob_password,
			'merchantid' => self::$dob_merchant_id
			],
			'query' => [
			'serviceid' => self::$dob_service_id,
			'msisdn' => $subscriber->phone_number,
			'PIN' => $pin_code,
			'TransactionID' => $subscriber->transaction_id
			]
			]);

		$response = $res->getBody();
		$response = json_decode($response, true);

		$subscriber->dob_response .= '<br />Check pin remove: '.$res->getBody();
		$subscriber->save();

		if($response['Response'] == 1){
			$status = 1;
			$message = 'Success';
			$subscriber->status = -1;
			$subscriber->save();
		}else if($response['Response'] == 13){
			$status = 300; // invalid pin code
			$message = 'invalid pin code';
		}else{
			$status = 302;
			$message = 'Please enter pin code';
		}

		return Response::json(['status' => $status, 'message' => $message]);
	}

}