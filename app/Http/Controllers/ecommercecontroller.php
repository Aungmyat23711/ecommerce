<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\protable;
use App\Models\catetable;
use App\Models\usertable;
use App\Models\cartable;
use App\Models\ordertable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ecommercecontroller extends Controller
{
    //
    function showproduct()
    {
        $product=protable::paginate(8);
        $category=catetable::all();
        //dd($product);
        return view('ecommerce/user/userinterface',['product'=>$product,'category'=>$category]);
    }
    function filterproduct($id)
    {
        $cateall=catetable::all();
        $category=catetable::find($id);
         $product=protable::where('category',$category->category)->paginate(8);
         return view('ecommerce/user/userinterface',['product'=>$product,'category'=>$cateall]);
    }
    function search(Request $req)
    {
        
            $search=protable::when($req->search,function($query,$search){
                     $query->where('product','like','%'.$search.'%')
                     ->orWhere('category','like','%'.$search.'%');
            })->paginate(8);
            $cateall=catetable::all();
            return view('ecommerce/user/userinterface',['product'=>$search,'category'=>$cateall]);
            // dd($search);
           
    }
    function loginuser(Request $req)
    {
        
            $user=usertable::where(['name'=>$req->name])->first();
            if(!$user || $req->password!=$user->password)
            {
                return dd('user and password not match');
            }else{
                $req->session()->put('user',$user);
                $get=$req->session()->get('user');
                return redirect('/userinterface');
            }
    }
    function logoutform(Request $req )
    {
        $req->session()->forget('user');
        return redirect('/userinterface');
    }
    function addcart(Request $req)
    {
        if($req->session()->has('user'))
        {
        $user_id=$req->session()->get('user')['id'];
        $cart=new cartable;
        $cart->user_id=$user_id;
        $cart->product_id=$req->product_id;
        $cart->qty=$req->qty;
        $cart->save();
        return redirect('/addcartlist');
        }
        else
        {
            return redirect('/loginform');
        }
         
    }
  static function cartcount()
    {
        $user_id=Session::get('user')['id'];
        $cart=cartable::where('user_id',$user_id)->count();
        return $cart;
    }
    function addcartlist()
    {
        $user_id=Session::get('user')['id'];
        $product=DB::table('cartable')
        ->join('protable','cartable.product_id','protable.id')
        ->where('cartable.user_id',$user_id)
        ->select('protable.*','cartable.id as cart_id','cartable.qty as cartqty')->get();
        return view('ecommerce/user/addcartlist',['product'=>$product]);
    }
    function removecart($id)
    {
       cartable::destroy($id);
      return redirect('/addcartlist');
    }
    
    function addordernow()
    {
        $user_id=Session::get('user')['id'];
        $total=DB::table('cartable')
        ->join('protable','cartable.product_id','protable.id')
        ->where('cartable.user_id',$user_id)
        ->select(DB::raw('sum(protable.price * cartable.qty) as total'))->get() ;
         
         $product=DB::table('cartable')
         ->join('protable','cartable.product_id','protable.id')
         ->where('cartable.user_id',$user_id)
         ->select('protable.*','cartable.qty as cartqty')->get();
         return view('ecommerce/user/ordernow',['total'=>$total,'product'=>$product]);
    }
    function addorderplace(Request $req)
    {  
        $user_id=Session::get('user')['id'];
        $carts=cartable::where('user_id',$user_id)->get();
        foreach($carts as $cart)
        {
           $order=new ordertable;
           $order->user_id=$cart['user_id'];
           $order->product_id=$cart['product_id'];
           $order->payment_status='pending';
           $order->payment_method=$req->cash;
           $order->user_status='pending';
           $order->address=$req->address;
           $order->cart_qty=$cart['qty'];
          $order->save();
          cartable::where('user_id',$user_id)->delete();
        }
        return redirect('/userinterface');
    }
    function showorderlist()
    {
        $user_id=Session::get('user')['id'];
        $order=DB::table('ordertable')
        ->join('protable','ordertable.product_id','protable.id')
        ->where('ordertable.user_id',$user_id)->get();
        return view('ecommerce/user/orderlist',['order'=>$order]);
    }
    function removelist()
    {
        $user_id=Session::get('user')['id'];
        ordertable::where('user_id',$user_id)->delete();
        return redirect('/showorderlist');
    }

}
