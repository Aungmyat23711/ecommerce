<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Inertia\Inertia;
use App\Models\category;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateRequest;

class inertiacontroller extends Controller
{
    //
    public function index(Request $req)
    {
        $all=product::where('product')->orWhere('category');
        $product=product::when($req->get('search') ?? '',function($query,$search){
            $query->where('product','like','%'.$search.'%')
            ->orWhere('category','like','%'.$search.'%');
        })->orderBy('id','desc')->paginate(5);
         return Inertia::render('User/Welcome',[
           'products'=>$product,
           'search'=>$req->get('search')
           
         ])->with(session()->forget('success'));
       
    }
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()
        ->route('user.index')
        ->with(session()->put('success','Delete Successfully'));

        
    }
    public function create(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'product'=>'required',
            'price'=>'required'
        ]);
        $data=new product;
        $data->category=$request->category;
        $data->product=$request->product;
        $data->price=$request->price;
        $data->save();
         
        return redirect()
        ->route('user.index')
        ->with(session()->put('success','Create Successfully'));
    }
    public function cat()
    {
        return Inertia::render('User/create',[
            'category'=>category::all(),
        ]);

    }
    public function edit(product $product)
    {
        return Inertia::render('User/edit',[
            'product'=>$product,
            'category'=>category::all()
        ]);
    }
    public function update(product $product,Request $req)
    {
        
        $product->update([
            'category'=>$req->category,
            'product'=>$req->product,
            'price'=>$req->price
        ]);
        return redirect()->route('user.index')
        ->with(session()->put('success','Edit Successfully'));
    }
}
