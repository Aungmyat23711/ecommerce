<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reactuser;
// use App\Models\session;
use App\Models\ctgory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\productone;
use Illuminate\Support\Facades\Storage;

class addreactcontroller extends Controller
{
    //
    function adduser(Request $req)
    {
      $data=new reactuser;
      $data->name=$req->name;
      $data->password=$req->password;
      $data->email=$req->email;
      $data->save();
    }
    function getuser()
    {
      $data=reactuser::all();
      
      return $data;
    }
    function deleteuser($id)
    {
      $data=reactuser::find($id);
      $data->delete();
    }
    function userlogin(Request $req,reactuser $react)
    {

      $req->validate([
        'name'=>['required','string'],
        'password'=>['required']

      ]);
      $info=reactuser::where(['name'=>$req->name])->first();
      if(!$info || !$req->password)
      {
        return $message='User name or password not match';
      }else{
         return $info;
      }
      
    }
    function postcategory(Request $req)
    {
         $data=new ctgory;
         $data->category_name=$req->category_name;
         $data->save();
    }
    function getcategory()
    {
      $data=ctgory::all();
      return $data;
    }
    function updatecategory(Request $req,$id)
    {
      $data=ctgory::find($id);
      $data->category_name=$req->category_name;
      $data->save();
    }
    function postproduct(Request $req,productone $product)
    {
      $req->validate([
        'productname'=>['required','string',Rule::unique('productones')->ignore($product->id,'id')],
        'category'=>['required','string'],
        'photo'=>['mimes:jpeg,jpg,png,gif'],
        'price'=>['required','numeric'],
        'qty'=>['required','numeric']
      ]);
       $file=$req->file;
       $ext=$file->getClientOriginalExtension();
       $photo=time().'.'.$ext;
       $url = Storage::url($photo);
       $path=$file->move('storage/',$url);
       $data=new productone;
       $data->productname=$req->productname;
       $data->category=$req->category;
       $data->photo=$url;
       $data->path=$path;
       $data->price=$req->price;
       $data->qty=$req->qty;
       $data->save();
      return $data->photo;
    }
    function getallproduct()
    {
      $data=productone::when(request('search'),function($query,$search){
        $query->where('productname','like','%'.$search.'%')
        ->orWhere('category','like','%'.$search.'%');
      })->orderBy('id','desc')->paginate(5);
      return $data;
    }
    function deleteproduct($id)
    {
      $data=productone::find($id);
      $data->delete();
    }
    function editproduct($id)
    {
       $data=productone::where('id',$id)->get();
       return $data;
    }
    function updateproduct(Request $req)
    {
      $data=productone::find($req->id);
      if($req->photo==null)
      {
         $data->productname=$req->productname;
         $data->category=$req->category;
         $data->price=$req->price;
         $data->qty=$req->price;
      }else
      {
        $file=$req->photo;
        $ext=$file->getClientOriginalExtension();
        $photo=time().'.'.$ext;
        $url=Storage::url($photo);
        $path=$file->move('storage/',$url);
      $data->productname=$req->productname;
      $data->category=$req->category;
      $data->photo=$url;
      $data->path=$path;
      $data->price=$req->price;
      $data->qty=$req->qty;
      }
       $data->save();
  }
  function getuserproduct()
  {
    $data=productone::paginate(8);
    return $data;
  }
  function getproductbycat($name)
  {
     $data=productone::where('category',$name)->paginate(8);
     return $data;
  }
}
