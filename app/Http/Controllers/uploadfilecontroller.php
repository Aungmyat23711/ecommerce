<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\protable;
use App\Models\catetable;
use App\Models\cartable;
use App\Models\ordertable;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\usertable;

class uploadfilecontroller extends Controller
{
    //
    public function index()
    {
     return view('laravel+vue/newproject');
    }
    public function getprodata(Request $req)
    {
        $product=protable::when(request('search'),function($query){
            $query->where('product','like','%'.request('search').'%')
            ->orWhere('category','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate(5);
        
        return $product;
    }
    public function getcategory()
    {
        return view('laravel+vue/newproject');
    }
    public function importcate(Request $req,catetable $cate)
    {
        
        $req->validate([
            'category'=>['required','string',Rule::unique('catetable')->ignore($cate->id,'id')]
            
        ],
    [
        'category.unique'=>'Insert Duplicated Data'
    ]);
        $data=new catetable;
        $data->category=$req->category;
        $data->save();
    }
    public function getcate()
    {
        return catetable::orderBy('id','desc')->get();
    }
    public function updatecate(Request $req)
    {
       $data=catetable::find($req->id);
       $data->category=$req->category;
       $data->save();
    }
    public function deletecate($id)
    {
        $data=catetable::find($id);
        $data->delete();
    }
    public function createpro()
    { 
         return view('laravel+vue/newproject');
    }
    public function getprocat()
    {
        return catetable::all();
    }
    public function postpro(Request $req,protable $pro)
    {
        $req->validate([
            'category'=>'required|string',
            'product'=>['required','string',Rule::unique('protable')->ignore($pro->id,'id')],
            'photo'=>['required',Rule::unique('protable')->ignore($pro->id,'id')],
            'price'=>'required|numeric',
            'qty'=>'required|numeric'
        ]);
         $files=$req->photo;
        //  $photo=$files->getClientOriginalName();
         $ext=$files->getClientOriginalExtension();
         $photo=time().'.'.$ext;
         $path=$files->move('image/',$photo);
         $data=new protable;
         $data->product=$req->product;
         $data->category=$req->category;
         $data->photo=$photo;
         $data->path=$path;
         $data->price=$req->price;
         $data->qty=$req->qty;
         $data->save();
         
    }
    public function deletepro($id)
    {
        $data=protable::find($id);
        $data->delete();
    }
    public function editpro()
    {
     return view('laravel+vue/newproject');
    }
    public function updatepro(protable $product,Request $req)
    {
        $req->validate([
            'product'=>['string','required',Rule::unique('protable')->ignore($product->id,'id')],
            'category'=>'required|string',
            
            'price'=>'required|numeric',
            'qty'=>'required|numeric'
        ]);
    if(!$req->photo)
    {
        $data=$product;
        $data->product=$req->product;
        $data->category=$req->category;
        $data->price=$req->price;
        $data->qty=$req->qty;
        $data->save();
        //dd($data);
    }else{
        $files=$req->photo;
        $ext=$files->getClientOriginalExtension();
        $photo=time().'.'.$ext;
        $path=$files->move('image/',$photo);
         $data=$product;
        $data->product=$req->product;
        $data->category=$req->category;
        $data->photo=$photo;
        $data->path=$path;
        $data->price=$req->price;
        $data->qty=$req->qty;
        $data->save();
        //dd($data);
        }

    }
    public function signin(Request $req)
    {
        
        if($req->password==$req->confirmpassword)
        {
            $req->validate([
                'name'=>['required','string'],
                'password'=>['required'],
                'email'=>['required','email'],
                'role'=>['required']
            ]);
            $data=new usertable;
            $data->name=$req->name;
            $data->password=$req->password;
            $data->email=$req->email;
            $data->role=$req->role;
            $data->save();
           return redirect('/upload');
            
        }else
        {
        $req->validate([
            'password'=>['required','confirmed'],
            'confirmpassword'=>['required']
        ]);
        }
      
    //   $data->save();
    }
    function getproducts()
    {
        $product=protable::when(request('search'),function($query,$search){
            $query->where('product','like','%'.$search.'%')
            ->orWhere('category','like','%'.$search.'%');
        })->paginate(8);
        return $product;
    }
    function getcategorys()
    {
        return catetable::all();
    }
    function login(Request $req)
    {
        $user=usertable::where(['name'=>$req->name])->first();
        if(!$user || $req->password!=$user->password)
        {
            dd('Username and password not match');
        }else{
            $req->session()->put('user',$user);
            $get=$req->session()->get('user');
            return redirect('/vue/showproduct');
        }
    }
    function getuser()
    {
        $user=Session::get('user');
        return $user;
    }
    function filter($id)
    {
       $filter=catetable::find($id);
       return $products=protable::where('category',$filter->category)->paginate(8);
       return redirect('/vue/showproduct');
    }
    function postid(Request $req,cartable $cart)
    {
        $req->validate([
            'product_id'=>[Rule::unique('cartable')->ignore($cart->id,'id')]
        ]);
      $cart=new cartable;
      $user=Session::get('user')['id'];
      $cart->user_id=$user;
      $cart->product_id=$req->product_id;
      $cart->qty=$req->qty;
      $cart->save();
      return redirect('/vue/showproduct');
    }
    function addcart()
    {

        $user_id=Session::get('user')['id'];
       return DB::table('cartable')
      ->join('protable','cartable.product_id','protable.id')
      ->where('cartable.user_id',$user_id)
      ->select('protable.*','cartable.id as cartid','cartable.qty as cartqty')->get();
    }
    function removecart($id)
    {
        cartable::destroy($id);
    }
    function logout(Request $request)
    {
        return $request->session()->forget('user');
    }
    // function showinfo($id)
    // {
    //    protable::find($id)->get();
    // }
    function viewinfo($id)
    {
      $product=protable::where('id',$id)->get();
      return $product;
    }
   function getmice()
   {
       return protable::where('category','mice')->inRandomOrder()->limit(4)->get();
   }
   function cartcount()
   {
       $user_id=Session::get('user')['id'];
       return cartable::where('user_id',$user_id)->count();
   }
   function totalprice()
   {
       $user_id=Session::get('user')['id'];
       $cart=DB::table('cartable')
       ->join('protable','cartable.product_id','protable.id')
       ->where('cartable.user_id',$user_id)
       ->select(DB::raw('sum(protable.price*cartable.qty) as total'))->get();
       return $cart;
   }
   function getitem()
   {
       $user_id=Session::get('user')['id'];
       $cart=DB::table('cartable')
       ->join('protable','cartable.product_id','protable.id')
       ->where('cartable.user_id',$user_id)
       ->select('protable.*','cartable.qty as cartqty')->get();
       return $cart;
   }
   function removeall()
   {
       $user_id=Session::get('user')['id'];
       return cartable::where('user_id',$user_id)->delete();
   }
   function postaddress(Request $req)
   {
       $req->validate([
           'customer_name'=>['required','string'],
           'payment_method'=>['required'],
           'address'=>['required','string'],
       ]);
       $user_id=Session::get('user')['id'];
       $cart=cartable::where('user_id',$user_id)->get();
       foreach($cart as $each)
       {
           $order=new ordertable;
           $order->product_id=$each['product_id'];
           $order->user_id=$each['user_id'];
           $order->customer_name=$req->customer_name;
           $order->payment_status='pending';
           $order->payment_method=$req->payment_method;
           $order->user_status='pending';
           $order->address=$req->address;
           $order->cart_qty=$each['qty'];
           $order->phone=$req->phone;
           $order->datetime=Carbon::now()->timezone('Asia/Rangoon')->format('Y-m-d H:i:s');;
            $order->save();  
            
       } 
      $product=protable::where('id',$each['product_id'])->get();
      foreach($product as $item)
      {
          $minus=$item->qty-$each['qty'];
          protable::where('id',$each['product_id'])
             ->update([
                 'qty'=>$minus
             ]);
             cartable::where('user_id',$user_id)->delete();
      }
   }
   function getmyorders()
   {
        $user_id=Session::get('user')['id'];
        $order=DB::table('ordertable')
        ->join('protable','ordertable.product_id','protable.id')
        ->where('ordertable.user_id',$user_id)
        ->select('protable.*','ordertable.cart_qty as cartqty',
        'ordertable.customer_name as name','ordertable.*')->get();
         return $order;
   }
   function getkeyboard()
   {
    return protable::where('category','keyboards')->inRandomOrder()->limit(4)->get();
   }
    
}
