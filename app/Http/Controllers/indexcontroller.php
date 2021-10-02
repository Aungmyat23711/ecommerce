<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\serie;
use App\Models\cart;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class indexcontroller extends Controller
{
    //
    function index()
    {
      $data=serie::all();
      return view('user/index',['data'=>$data]);
    }

    function userlog(Request $req)
    {
      $validatedData=$req->validate([
       
       
       
      ]);
      $user=User::where(['email'=>$req->useremail])->first();
      $connection=mysqli_connect('localhost','root','','series');
      $query="select * from  users";
      $go_query=mysqli_query($connection,$query);
      while($out=mysqli_fetch_array($go_query))
      {
        $email=$out['email'];
        $name=$out['name'];
        $password=$out['password'];
        $role=$out['role'];

      }
      if(!$user || !Hash::check($req->password,$user->password))
      {
        echo "<script>window.alert('Password or Username not matched')</script>";
        return redirect('loginuser');
      }
      if(Session::get('user')['role']=='admin')
      {
        $req->session()->put('admin',$user);
        return redirect('dashboard');
      }
      else{
        echo "<script>window.alert('Ready Now')</script>";
        $req->session()->put('user',$user);
        return redirect('/');
      }
    }
    function logoutuser(Request $req)
    {
      $req->session()->forget('user');
      return redirect('loginuser');
    }
    function detail($id)
    {
      $data=serie::find($id);
      $footer=serie::all();
      return view('user/detail',['product'=>$data,'pdt'=>$footer]);

    }
    function register(Request $req)
    {
       
       $data=new User;
       $data->name=$req->name;
       $data->password=Hash::make($req->password);
       $data->email=$req->email;
       $data->role='user';
       $data->save();
       return redirect('loginuser');

    }
    function addtocart(Request $req)
    {
      if(session()->has('user'))
      {
        $data=new cart;
        $data->user_id=$req->session()->get('user')['id'];
      $data->product_id=$req->product_id;
      $data->save();
      return redirect('cartlist');
      }else{
        return redirect('loginuser');
      }
      
    }
    static function cartItem()
    {
     $userId=Session::get('user')['id'];
     return cart::where('user_id',$userId)->count();
    }
    function cartlist()
    {
      $userId=Session::get('user')['id'];
      $product=DB::table('carts')
      ->join('series','carts.product_id','=','series.id')
      ->where('carts.user_id',$userId)
      ->select('series.*','carts.id as cart_id')->get();
      return view('user/cartlist',['product'=>$product]);
    }

    function removecart($id)
    {
      cart::destroy($id);
      return redirect('cartlist');
    }
    function ordernow()
    {
      $userId=Session::get('user')['id'];
      $total=DB::table('carts')
      ->join('series','carts.product_id','=','series.id')
      ->where('user_id',$userId)
      ->select('series.*','carts.id as cart_id')
      ->sum('series.price');
      return view('user/ordernow',['total'=>$total]); 
    }

    function orderplace(Request $req)
    {
      $userId=Session::get('user')['id'];
      $allcart=cart::where('user_id',$userId)->get();
      foreach($allcart as $cart)
      {
        $order=new order;
        $order->user_id=$cart['user_id'];
        $order->product_id=$cart['product_id'];
        $order->status='pending';
        $order->payment_method=$req->payment;
        $order->payment_status='pending';
        $order->address=$req->address;
        $order->save();
        cart::where('user_id',$userId)->delete();
      }
      return redirect('/');
    }
    function myorder()
    {
      $userId=Session::get('user')['id'];
      $order=DB::table('orders')
      ->join('series','orders.product_id','=','series.id')
      ->where('orders.user_id',$userId)
      ->select('orders.id as orderId')
      ->get();
      return view('user/myorder',['order'=>$order]);
      
    }
    function userorder()
    {
      $userId=Session::get('user')['id'];
      $order=DB::table('orders')
      ->join('series','orders.product_id','=','series.id')
      ->where('orders.user_id',$userId)
      ->get();
      return view('admin/userorder',['order'=>$order]);
      
    }
    function approve()
    {
      $userId=Session::get('user')['id'];
      $order=order::where('user_id',$userId)->update(['status'=>'approved','payment_status'=>'approved']);
      return redirect('userorder');
    }
    function clearhistory()
    {
      $order=DB::delete('delete from orders');
      return redirect('myorder');
    }
    function cancleorder($id)
    {
      order::destroy($id);
      return redirect('myorder');
    }
    function getdata($id)
    {
      
      $data=User::find($id);
      $data->delete();
      return $data;
    }
    function getall()
    {
      return User::all();
    }
    function addapi(Request $req)
    {
      $data=new User;
      $data->name=$req->name;
      $data->id=$req->id;
      $data->email=$req->email;
      $data->role=$req->role;
      $result=$data->save();
      if($result)
      {
        return ["Result"=>"Data has been saved"];
      }else{
        return ["Result"=>"Operation Failed"];
      }
    }
  
}
