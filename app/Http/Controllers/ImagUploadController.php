<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImagUploadController extends Controller
{
    //
    public function index()
    {
        return view('previewimg/imageupload');
    }
    public function upload(Request $request)
    {
        
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('uploads');
        $save = new Image;
        $save->name = $name;
        $save->path = $path;
        $save->save();
        return redirect('image')->with('status', 'Image Has been uploaded successfully with validation in laravel');
    }
}
