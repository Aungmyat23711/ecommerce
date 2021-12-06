<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\DB;
use App\Models\ecategory;
use Illuminate\Validation\Rule;
use App\Models\eproduct;
use App\Models\euser;
use App\Models\ecart;
use App\Models\eorder;
use App\Models\ephoto;
class ecocontroller extends Controller
{
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
        $data=ecategory::orderBy('id','desc')->paginate(15);
        return $data;
    }
    function getprophoto()
    {
        $data=eproduct::when(request('search'),function($query){
            $query->where('product','like','%'.request('search').'%')
            ->orWhere('category','like','%'.request('search').'%');
        })->get();
        return $data;
    }
    function eachproduct($id)
    {
        $data=eproduct::where('id',$id)->get();
        return $data;
    }
    function countphoto($id)
    {
        $data=DB::table('ephotos')
        ->join('eproducts','ephotos.product_id','eproducts.id')
        ->where('ephotos.product_id',$id)
        ->select('ephotos.*')
        ->count();
        return $data;
    }
    function uploadphoto(Request $req)
    {
       $file=$req->photo;
       $ext=$file->getClientOriginalExtension();
       $photo=time().'.'.$ext;
       $path=$file->move('images/',$photo);
       $data=new ephoto;
       $data->photo=$photo;
       $data->path=$path;
       $data->product_id=$req->product_id;
       $data->save();
       return response()->json(['success'=>'Operation Success']);
    }
    function getphoto($id)
    {
        $data=ephoto::where('product_id',$id)->get();
        return $data;
    }
    function deletephoto($id)
    {
       $data=DB::delete('delete from ephotos where id=?',[$id]);
       return $data;
    }
    function deletecategory($id)
    {
        $data=DB::delete('delete from ecategories where id=?',[$id]);
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
        $data=DB::delete('delete from eproducts where id=?',[$id]);
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
    function searchallproducts(Request $req)
    {
       $data=eproduct::when(request('search'),function($query){
           $query->where('product','like','%'.request('search').'%')
           ->orWhere('category','like','%'.request('search').'%');
       })->get();
       $count=eproduct::where('category','like','%'.request('search').'%')->orWhere('product','like','%'.request('search').'%')->count();
       return [$data,$count];
      
    }
    function getallproducts()
    {
       $data=eproduct::paginate(8);
       return $data;
    }
    function getusercategory()
    {
        $data=ecategory::all();
        return $data;
    }
    function getproductbycat(Request $req)
    {
        $data=eproduct::where('category',request('cat'))->get();
        $count=eproduct::where('category',request('cat'))->count();
        return [$data,$count];
    }
    function getinfo($id)
    {
      $data=eproduct::find($id);
      return $data;
    }
    function registeruser(Request $req)
    {
        $req->validate([
            'name'=>['required','string'],
            'password'=>['required'],
            'cpassword'=>['required'],
            'email'=>['required','email']
        ]);
       $data=new euser;
       if($req->cpassword!=$req->password)
       {
           return response()->json(['message'=>'password not match']);
       }
       else
       {   
           $data->name=$req->name;
           $data->password=$req->password;
           $data->email=$req->email;
           $data->save();
       }
       
    }
    function addlogin(Request $req)
    {
       $req->validate([
           'email'=>['required','email'],
           'password'=>['required']
       ]);
       $user=euser::where(['email'=>$req->email])->first();
       if(!$user || $req->password!=$user->password)
       {
           return response()->json(['loginerror'=>'username or password not match']);
       }else
       {
            $req->session()->put('userinfo',$user);
            return response()->json(['oneuser'=>$user]);
       }
    }
    function postdetails(Request $req)
    {
       $data=new ecart;
       $data->user_id=$req->user_id;
       $data->product_id=$req->product_id;
       $data->qty=$req->qty;
       $data->save();
    }
    function getcount()
    {
        $data=ecart::all()->count();
        return $data;
    }
    function getcartitem($id)
    {
        $cart=DB::table('ecarts')
        ->join('eproducts','ecarts.product_id','eproducts.id')
        ->where('ecarts.user_id',$id)
        ->select('eproducts.*','ecarts.qty as cartqty','ecarts.id as cartid')->get();
        return $cart;
    }
    function getall()
    {
        $data=eproduct::paginate(8);
        return $data;
    }
    function deletecart(Request $req,$id)
    {
        $data=DB::delete('delete from ecarts where id=?',[$id]);
        return $data;
    }
    function getcartitems($id)
    {
        $order=DB::table('ecarts')
        ->join('eproducts','ecarts.product_id','eproducts.id')
        ->where('ecarts.user_id',$id)
        ->select('eproducts.*','ecarts.qty as eqty')
        ->get();
        $total=DB::table('ecarts')
        ->join('eproducts','ecarts.product_id','eproducts.id')
        ->where('ecarts.user_id',$id)
        ->select(DB::raw('sum(eproducts.price*ecarts.qty) as total'))->get();
        return [$total,$order];
    }
    function ordernow(Request $req)
    {
      $req->validate([
          'email'=>['required','email'],
          'address'=>['required'],
          'payment_method'=>['required'],
          'phone'=>['required','numeric']
      ]);
      $cart=ecart::where('user_id',$req->user_id)->get();
      $carts=ecart::where('user_id',$req->user_id);
      foreach($cart as $item)
      {
          $data=new eorder;
          $data->user_id=$item->user_id;
          $data->product_id=$item['product_id'];
          $data->email=$req->email;
          $data->address=$req->address;
          $data->payment_method=$req->payment_method;
          $data->payment_status='pending';
          $data->customer_name=$req->user_name;
          $data->datetime=$req->datetime;
          $data->user_status='pending';
          $data->phone=$req->phone;
          $data->cart_qty=$item['qty'];
          $data->save(); 
          $product=eproduct::find($item->product_id);
          $product->decrement('qty',$item->qty);
          ecart::where('user_id',$item->user_id)->delete();
      }
    }
    function myorder($id)
    {
        $data=DB::table('eorders')
        ->join('eproducts','eorders.product_id','eproducts.id')
        ->where('eorders.user_id',$id)
        ->select('eproducts.*','eorders.*')->get();
        return $data;
        
    }
    function getphotos($id)
    {
        $data=ephoto::where('product_id',$id)->get();
        return $data;
    }
}
