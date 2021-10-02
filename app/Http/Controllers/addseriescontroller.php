<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\serie;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\session;
class addseriescontroller extends Controller
{
    //
    function addseries(Request $req)
    {
        $validatedData=$req->validate([
            'photo'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'=>'required|string',
            'type'=>'required|string',
            'genre'=>'required|string',
            'link'=>'required|string',

        ]);
       
        
        $name=$req->file('photo')->getClientOriginalExtension();
        $now=time().'.'.$name;
        $path=$req->file('photo')->move('images/',$now);
        $data=new serie;
        $data=serie::firstorcreate(['name'=>$req->name],['photo'=>$req->photo,'link'=>$req->link]);
        $data->name=$req->name;
        $data->type=$req->type; 
        $data->photo=$now;
        $data->path=$path;
        $data->genre=$req->genre;
        $data->link=$req->link;
        $data->price=$req->price;
        $data->qty=$req->qty;
        //$data->save();
        dd($req->file('photo'));
        return redirect('viewseriesurl');

    }
    function viewseries()
    {
        $data=serie::all();
        return view('admin/viewseries',['data'=>$data]);
    }
    function delete($id)
    {
        DB::delete('delete from series where id=?',[$id]);
        return redirect('viewseriesurl');
    }
    function showedit($id)
    {
        $data=DB::select('select * from series where id=?',[$id]);
        return view('admin/showedit',['data'=>$data]);
        
    }
    function update(Request $req)
    {
        $validatedData=$req->validate([
            'name'=>'required|string',
            'type'=>'required|string',
            'genre'=>'required|string',
            'link'=>'required|string',
        ]);
        $file=$req->file('photo');
        $extension=$file->getClientOriginalExtension();
        $now=time().'.'.$extension;
        $path=$file->move('images/',$now);
        $data=serie::find($req->id);
        $data->name=$req->name;
        $data->type=$req->type;
        $data->photo=$now;
        $data->path=$path;
        $data->genre=$req->genre;
        $data->link=$req->link;
        $data->price=$req->price;
        $data->qty=$req->qty;
        $data->save();
        return redirect('viewseriesurl');
        
    }
    function adduser(Request $req)
    {
       
        $validatedData=$req->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|min:4|max:12',
            'role'=>'required|string',
        ]); 
        $pass=Hash::make($req->password);
        $data=new User;
        $data->password=$pass;
        $data->role=$req->role;
        if($req->name!='' && $req->email!='')
        {
            $connection=mysqli_connect('localhost','root','','series');
            $query="select * from users where name='$req->name' and email='$req->email'";
            $go_query=mysqli_query($connection,$query);
            $num=mysqli_num_rows($go_query);
            if($num>0)
            {
                echo '<script>window.alert("User has been already asign")</script>';
                return view('admin/adduser');
            }
            else
            {
                
                $data->name=$req->name;
                $data->email=$req->email;
                 $data->save();
               return redirect('adduserurl');
            }
        }
}

    function login(Request $req)
    {
    
     $connection=mysqli_connect('localhost','root','','series');
     $query="select * from users";
     $go_query=mysqli_query($connection,$query);
     while($out=mysqli_fetch_array($go_query))
     {
         $email=$out['email'];
         $name=$out['name'];
         $password=$out['password'];
     }
     $user=User::where(['email'=>$req->email])->first();
     if(!$user || !Hash::check($req->password,$user->password))
     {
         echo "<script>window.alert('User Name or password not matched')</scrtip>";
         return redirect('useradd');
     }
     else{
        $req->session()->put('admin',$user);
         return redirect('dashboard');
     }
    }
    function logout(Request $req)
    {
            $req->session()->forget('admin');
            return view('admin/login');
    }
}

