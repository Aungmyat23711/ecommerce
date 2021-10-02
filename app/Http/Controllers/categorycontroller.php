<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Http\Request\CategorylistRequest;
class categorycontroller extends Controller
{
    //
    public function addcat(Request $req)
    {
        $req->validate([
            'category'=>'required|string'
        ],
        [
            'category.required'=>'Please Enter Category-Name'
        ]);
        $data=category::firstOrCreate([
            'category'=>$req->category
        ]);
        if($data)
        {
            echo '<script>window.alert("Already Exists")</script>';
        }     
        else{
            $data->category=$req->category;
            $data->save();
        }
        
        
    }
    public function getcat()
    {
        return category::when(request('search'),function($query){
            $query->where('category','like','%'.request('search').'%');
        })->paginate(5);
    }
    public function delcat($id)
    {
      $data=category::find($id);
      $data->delete();
    }
    public function updatecat(Request $req)
    {
      
         $connect=mysqli_connect('localhost','root','','productsale');
         $query='select * from categories';
         $go_query=mysqli_query($connect,$query);
         $count=mysqli_num_rows($go_query);
         if($count>0)
         {
             echo "<script>alert('Duplicated Data')</script>";
         }else{
             $data=category::find($req->id);
             $data->category=$req->category;
             $data->save();  
         }
         
      }
      public function getcatfrompro()
      {
          $data=category::all();
          return $data;
      }
      
}

