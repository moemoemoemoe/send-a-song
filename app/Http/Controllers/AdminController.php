<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
use Redirect;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }
    public function categories_index()
    {
        $categories = Category::orderBy('id' , 'DESC')->get();

        return view('admin.categories_index',compact('categories'));
    }
    public function categories_create()
    {


        return view('admin.categories_create');
    }
 public function categories_store(Request $r){
        $original_name = $r->input('original_name');
        $foreign_name = $r->input('foreign_name');
        $photo = $r->file('photo');

        $data = ['original_name' => $original_name, 'foreign_name' => $foreign_name, 'photo' => $photo];
        $rules = ['original_name' => 'required', 'foreign_name' => 'required', 'photo' => 'required'];

        $v = Validator::make($data, $rules);

        if($v->fails()){
            return Redirect::Back()->withErrors($v);
        }else{

            if($r->has('details')){
                $details = $r->input('details');
            }else{
                $details = '';
            }

            $destination = 'images/categories';
            $photo_name = str_replace(' ', '_', $foreign_name);
            $photo_name .= '.'.$photo->getClientOriginalExtension();
            $photo->move($destination, $photo_name);

            $category = new Category();
            $category->original_name = $original_name;
            $category->foreign_name = $foreign_name;
            $category->photo_name = $photo_name;
            $category->details = $details;
            $category->is_active = 0;
            $category->save();

            return Redirect::back()->with('success', 'New category successfuly created');
        }
    }


public function categories_view($id){
        $category = Category::findOrFail($id);
        
        return view('admin.categories_view', compact('category'));
    }

     public function categories_update(Request $r, $id){
        $original_name = $r->input('original_name');
        $foreign_name = $r->input('foreign_name');

        $data = ['original_name' => $original_name, 'foreign_name' => $foreign_name];
        $rules = ['original_name' => 'required', 'foreign_name' => 'required'];

        $v = Validator::make($data, $rules);

        if($v->fails()){
            return Redirect::Back()->withErrors($v);
        }else{
            if($r->has('details')){
                $details = $r->input('details');
            }else{
                $details = '';
            }

            if($r->hasFile('photo')){
                $photo = $r->file('photo');
                $destination = 'images/categories';
                $photo_name = str_replace(' ', '_', $foreign_name);
                $photo_name .= '.'.$photo->getClientOriginalExtension();
                $photo->move($destination, $photo_name);
            }

            $category = Category::findOrFail($id);
            $category->original_name = $original_name;
            $category->foreign_name = $foreign_name;
            if($r->hasFile('photo')){
            $category->photo_name = $photo_name;
            }
            $category->details = $details;
            $category->is_active = 0;
            $category->save();

            return Redirect::back()->with('success', 'Category successfuly updated');
        }
    }
    public function publish_category($id)
    {

         $categorie = Category::findOrFail($id);
         if($categorie->is_active == '0')
         {
         $categorie->is_active = '1';
         $categorie->save();
         return Redirect::Back()->with('success', 'This category is Published');
 }
     else{
      $categorie->is_active = '0';
        $categorie->save();
        return Redirect::Back()->with('success', 'This category is Unpublished');
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
