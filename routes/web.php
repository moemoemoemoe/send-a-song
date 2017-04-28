<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'GuestController@index']);



Route::get('profile/{uid}', ['as' => 'profile', 'uses' => 'GuestController@profile']);
Route::get('artist/{id}', ['as' => 'artist', 'uses' => 'GuestController@artist']);
Route::get('categories/{id}', ['as' => 'categories', 'uses' => 'GuestController@categories']);


Route::get('search/{id}', ['as' => 'search', 'uses' => 'GuestController@search']);
Route::post('new-subscriber-rec', ['as' => 'new_subscriber_rec', 'uses' => 'SubscribeController@new_subscriber_rec']);

Route::get('all_artist', ['as' => 'all_artist', 'uses' => 'GuestController@artist_all']);

Route::post('new-subscriber', ['as' => 'new_subscriber', 'uses' => 'SubscribeController@new_subscriber']);


Route::post('check-pin-code', ['as' => 'check_pin_code', 'uses' => 'SubscribeController@check_pin_code']);



Route::post('sendthissong', ['as' => 'sendthissong', 'uses' => 'SubscribeController@send_song']);

Route::post('new_one_time_payment', ['as' => 'new_one_time_payment', 'uses' => 'SubscribeController@new_one_time_payment']);

Route::post('check-pin-code-one-time', ['as' => 'check_pin_code_one_time', 'uses' => 'SubscribeController@check_pin_code_one_time']);

Route::get('subscribe', ['as' => 'subscribe', 'uses' => 'GuestController@subscribe']);
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'GuestController@autocomplete'));