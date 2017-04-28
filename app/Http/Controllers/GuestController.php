<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Song;
use paginate;
use App\Category;
use App\Subscriber;
use App\Artist;
use App\Helper;
use Redirect;
use Session;


class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
Session::forget('uniqueid_profile');
        $artist = Artist::where('is_active' , 1)->orderBy('id' , 'DESC')->paginate(12);
        $artists = Artist::where('is_active' , 1)->orderBy('id' , 'DESC')->get();

        $songs_most = Song::with('artist')->where('is_active', 1)->orderBy('number_of_send' ,'DESC')->paginate(10);
        $songs = Song::with('artist')->where('is_active', 1)->orderBy('id', 'DESC')->get();
        $songsasc = Song::with('artist')->where('is_active', 1)->orderBy('id', 'ASC')->paginate(10);
        $categories = Category::where('is_active', 1)->get();
        $newsongs = Song::with('artist')->where('is_active', 1)->where('is_new', 1)->orderBy('id', 'DESC')->paginate(4);
        $newsongsone = Song::with('artist')->where('is_active', 1)->where('is_new', 1)->orderBy('id', 'ASC')->paginate(4);
        return view('layouts.layout',compact('songs','newsongs','categories','songs_most','artist','newsongsone','songsasc','artists'));
    }
   public function search($key)
   {
$search_res = Song::where('original_name',"LIKE","%$key%")->orderBy('id' , 'DESC')->paginate(4);
$search_res_count = Song::where('original_name',"LIKE","%$key%")->count();
$keyword = $key;
  $songs_most = Song::with('artist')->where('is_active', 1)->orderBy('number_of_send' ,'DESC')->paginate(10);
//return $search_res;
return view('guest.search',compact('search_res','search_res_count','keyword','songs_most'));

   }

     public function autocomplete(Request $request)
    {
        $data = Song::select("original_name as name")->where("original_name","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
   

    public function profile($uid)
    {
     
     $check = Subscriber::where('uid', $uid)->whereDate('end_sub_date', '>=', date('Y/m/d'))->whereIn('status', [1,-1])->count();
     // return $check;

     if($check == 1){
            // check subscriber subscription status
      $subscriber = Subscriber::where('uid', $uid)->whereDate('end_sub_date', '>=', date('Y/m/d'))->whereIn('status', [1,-1])->firstOrFail();
      $msg_user = $subscriber->phone_number;
      if($subscriber->basket <= 0)
      {
$msg = 'Empty';
$msg_date = 'Your subscription valid till '.$subscriber->end_sub_date;

     }else {
     $msg = $subscriber->basket.'  Song/s';
  $msg_date = 'Your subscription valid till '.$subscriber->end_sub_date;
  }
  Session::put('uniqueid_profile' , $uid);
  Session::put('phone' , $subscriber->phone_number);
  $status = Helper::check_subscription($subscriber->id, 'lb')->content();
  $status = json_decode($status, true);
  //return $status;
  if($status['end_date'] >= date('Y/m/d')){
   $artist = Artist::where('is_active' , 1)->orderBy('id' , 'DESC')->get();
   $songs_most = Song::with('artist')->where('is_active', 1)->orderBy('number_of_send' ,'DESC')->paginate(10);
   $artists = Artist::where('is_active' , 1)->orderBy('id' , 'DESC')->get();
   $songs = Song::with('artist')->where('is_active', 1)->orderBy('id', 'DESC')->get();
   $songsasc = Song::with('artist')->where('is_active', 1)->orderBy('id', 'ASC')->paginate(10);
   $categories = Category::where('is_active', 1)->get();
   $newsongs = Song::with('artist')->where('is_active', 1)->where('is_new', 1)->orderBy('id', 'DESC')->paginate(4);
   $newsongsone = Song::with('artist')->where('is_active', 1)->where('is_new', 1)->orderBy('id', 'ASC')->paginate(4);
   return view('layouts.layout',compact('songs','newsongs','categories','songs_most' , 'msg' ,'msg_user' ,'artist','songsasc','newsongsone','artists','msg_date'));    
}else{
  $subscriber->status = -1;
  $subscriber->save();
  return Redirect::route('home')->with('message', 'Your subscription has expired');
}
}else{
 
  return Redirect::route('home')->with('message', 'User is not found');
}



}


public function artist($id)
{
$artist_details = Artist::where('id', $id)->firstOrFail();
$artist_more = Artist::orderBy('id','DESC')->paginate(8);
$songs_artist = Song::where('artist_id', $id)->get();
$count = Song::where('artist_id', $id)->count();


  return view('guest.artist' , compact('artist_details','songs_artist','count','artist_more'));


}

public function categories($id)
{

$artist_details = Category::where('id', $id)->firstOrFail();
$artist_more = Artist::orderBy('id','DESC')->paginate(8);
$songs_artist = Song::where('category_id', $id)->get();
$count = Song::where('category_id', $id)->count();


  return view('guest.categories' , compact('artist_details','songs_artist','count','artist_more'));


}
public function artist_all()
{
$artist = Artist::orderBy('id','DESC')->get();

  return view('guest.all_artist' , compact('artist'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe()
    {
      return view('guest.subscribe');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
