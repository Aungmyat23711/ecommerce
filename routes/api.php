<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\productapicontroller;
use App\Http\Controllers\addreactcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::delete('posts/{id}', [indexcontroller::class, 'getdata']);
Route::get('posts', [indexcontroller::class, 'getall']);
Route::match(['get','post'],'addapi', [indexcontroller::class, 'addapi']);
Route::match(['get','post'],'addproductsale',[productapicontroller::class,'addapi']);
Route::get('productsale',[productapicontroller::class,'getapi']);
Route::delete('productsale/{id}',[productapicontroller::class,'deleteapi']);
Route::match(['get','post'],'adduser',[addreactcontroller::class,'adduser']);

Route::delete('deleteuser/{id}',[addreactcontroller::class,'deleteuser']);
Route::match(['get','post'],'userlogin',[addreactcontroller::class,'userlogin']);
Route::get('getsession',[addreactcontroller::class,'getsession']);\
Route::get('getuser',[addreactcontroller::class,'getuser']);
Route::match(['get','post'],'addcategory',[addreactcontroller::class,'postcategory']);
Route::get('getcategory',[addreactcontroller::class,'getcategory']);
Route::put('updatecategory/{id}',[addreactcontroller::class,'updatecategory']);
Route::match(['get','post'],'postproduct',[addreactcontroller::class,'postproduct']);
Route::get('getallproduct',[addreactcontroller::class,'getallproduct']);
Route::delete('deleteproduct/{id}',[addreactcontroller::class,'deleteproduct']);
Route::get('goeditproduct/{id}',[addreactcontroller::class,'editproduct']);
Route::put('updateproduct/{id}',[addreactcontroller::class,'updateproduct']);
Route::get('/user/getallproduct',[addreactcontroller::class,'getuserproduct']);
Route::get('/user/getallproduct/{name}',[addreactcontroller::class,'getproductbycat']);
