<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class productapicontroller extends Controller
{
    //
    public function addapi(Request $req)
    {
        $req->validate(
            [
                'product'=>'required|string',
                'price'=>'required|numeric'
            ],
            [
                'product.required'=>'This field should not empty',
                'price.required'=>'This field should not empty',
                'product.string'=>'Data should be string',
                'product.numeric'=>'Data should be numeric'
            ]
            );
      $data=product::firstOrCreate([
          'product'=>$req->product,
      ]);
      $data->price=$req->price;
      $data->save();
       return view('laravel+vue/crud');
    }
    public function getapi()
    {
      return product::when(request('search'),function($query){
         $query->where('product','like','%'.request('search').'%')
         ->orWhere('category','like','%'.request('search').'%');
      })->paginate(5);
    }
    public function deleteapi($id)
    {
        $data=product::find($id);
        $data->delete();
    }
    public function updateapi(Request $req)
    {
        $data=product::find($req->id);
        $data->category=$req->category;
        $data->product=$req->product;
        $data->price=$req->price;
        $data->save();
    }
    
}
