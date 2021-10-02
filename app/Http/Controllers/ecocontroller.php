<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\DB;
use App\Models\ecategory;
use Illuminate\Validation\Rule;
use App\Models\eproduct;

class ecocontroller extends Controller
{
    //
    function postadmin(Request $req)
    {
        $req->validate([
            'name'=>['required','string'],
            'password'=>['required'],
            'confirm_password'=>['required'],
            'email'=>['required','email']
        ]);
        $data=new admin;
        $data->name=$req->name;
        if($req->password!=$req->confirm_password)
        {
            return response()->json(['message'=>'Password did not match']);
        }
        else{
           
           
           $data->password=$req->password;
           $data->email=$req->email;
           $data->save();
           return response()->json(['message'=>'']);
        }
        
    }
    function loginpost(Request $req)
    {
        $req->validate([
            'email'=>['required','string'],
            'password'=>['required']
        ]);
        $user=admin::where('email',$req->email)->first();
        if(!$user || $req->password!=$user->password)
        {
            $message='Email or Password did not match';
            return redirect('/ecommerce/login');
        }else{
            $session=$req->session()->put('user',$user);
            $get=$req->session()->get('user');
            return response()->json(['user'=>$get]);
        }
        
    }
    function logoutuser(Request $req)
    {
        return $req->session()->forget('user');
    }
    function getusername(Request $req)
    {
        return $req->session()->get('user');
    }
    function postcategory(Request $req,ecategory $ecat)
    {
        $req->validate([
            'category'=>['required',Rule::unique('ecategories')->ignore($ecat->id,'id')]
        ]);
        $data=new ecategory;
        $data->category=$req->category;
        $data->save();
        return redirect('/ecommerce/category');
    }
    function getcategory()
    {
        $data=ecategory::paginate(5);
        return $data;
    }
    function deletecategory($id)
    {
        $data=ecategory::find($id);
        $data->delete();
        return $data;
    }
    function addproduct(Request $req,eproduct $pro)
    {
        $req->validate([
            'product'=>['required','string',Rule::unique('eproducts')->ignore($pro->id,'id')],
            'category'=>['required','string'],
            'photo'=>['required'],
            'price'=>['required','numeric'],
            'qty'=>['required','numeric']
        ]);
        $file=$req->photo;
        $ext=$file->getClientOriginalExtension();
        $photo=time().'.'.$ext;
        $path=$file->move('images/',$photo);
        $data=new eproduct;
        $data->product=$req->product;
        $data->category=$req->category;
        $data->photo=$photo;
        $data->path=$path;
        $data->price=$req->price;
        $data->qty=$req->qty;
        $data->save();
    }
    function updatecategory(Request $req,$id,ecategory $cat)
    {
        $req->validate([
            'category'=>['required','string',Rule::unique('ecategories')->ignore($cat->id,'id')]
        ]);
       $data=ecategory::find($id);
       $data->category=$req->category;
       $data->save();
    
    }
    function getproducts()
    {
        $data=eproduct::orderBy('id','desc')->paginate(5);
        return $data;
    }
    function deleteproduct($id)
    {
        $data=eproduct::find($id);
        $data->delete();
    }
    function editpost($id)
    {
       $data=DB::table('eproducts')->get();
       return $data;
    }
    function updatepost($id,Request $req)
    {
        $data=eproduct::find($id);
        
        if($req->photo==null)
        {
            $data->product=$req->product;
            $data->category=$req->category;
            $data->price=$req->price;
            $data->qty=$req->qty;
            $data->save();
            // dd('photo is null');
        }else{
            $file=$req->photo;
            $ext=$file->getClientOriginalExtension();
            $photo=time().'.'.$ext;
            $path=$file->move('images/',$photo);
            $data->product=$req->product;
            $data->category=$req->category;
            $data->photo=$photo;
            $data->path=$path;
            $data->price=$req->price;
            $data->qty=$req->qty;
            // dd('photo is not null');
            $data->save();  
        }


    }
    function getsearch(Request $req)
    {
    $data=eproduct::where('category','like','%'.$req->searchname.'%')
    ->orwhere('product','like','%'.$req->searchname.'%')->paginate(5);
    return $data;
    }
}
