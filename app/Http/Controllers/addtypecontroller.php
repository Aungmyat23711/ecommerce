<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type;
use Illuminate\Support\Facades\DB;

class addtypecontroller extends Controller
{
    //
    function addtype(Request $req)
    {
        session_start();
        $data=new type;
        $data->name=$req->type;
        if($req->type=='')
        {
            $_SESSION['message']='Please Enter Name';
            return redirect('viewtype');
        }
        else{
            unset($_SESSION['message']);
        $data->save();
        return redirect('viewtype');
        }
    }
    function viewtype()
    {
        $data=type::all();
        return view('admin/type',['data'=>$data]);
    }
    function delete($id)
    {
        DB::delete('delete from types where id=?',[$id]);
        return redirect('viewtype');
    }
    function viewedit($id)
    {
        $data=DB::select("select * from types where id=?",[$id]);
        return view('admin/edit',['data'=>$data]);
    }
    function update(Request $req)
    {
        $data=DB::table('types')->where('id',[$req->id])->update([
            'name'=>$req->type,
        ]);
        return redirect('viewtype');
    }
}
