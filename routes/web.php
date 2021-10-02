<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addtypecontroller;
use App\Http\Controllers\addseriescontroller;
use App\Http\Controllers\ImagUploadController;
use App\Http\Controllers\indexcontroller;
use App\Http\Controllers\productapicontroller;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\inertiacontroller;
use Inertia\Inertia;
use App\Http\Controllers\uploadfilecontroller;
use App\Http\Controllers\ecommercecontroller;
use App\Http\Controllers\addreactcontroller;
use App\Http\Controllers\ecocontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//for admin/type
// Route::get('/', function () {
//     return view('welcome');
// });




//for inertia//
Route::get('/inertia',function()
{
    return Inertia::render('Welcome');
});
Route::get('/user/index',[inertiacontroller::class,'index'])->name('user.index');
Route::delete('/user/{product}',[inertiacontroller::class,'destroy']);
Route::match(['get','post'],'/user/create',[inertiacontroller::class,'create']);
Route::get('/user/category',[inertiacontroller::class,'cat']);
Route::get('/user/{product}/edit',[inertiacontroller::class,'edit']);
Route::put('/user/update/{product}',[inertiacontroller::class,'update']);

//Route::view('/','laravel+vue/newproject');
Route::get('/userinterface',[ecommercecontroller::class,'showproduct'])->name('userinterface.showproduct');
Route::get('/filter/{id}',[ecommercecontroller::class,'filterproduct']);
Route::match(['get','post'],'/search',[ecommercecontroller::class,'search']);
Route::match(['get','post'],'/loginfor',[ecommercecontroller::class,'loginuser']);
Route::view('loginform','ecommerce/user/login');
Route::match(['get','post'],'/logoutform',[ecommercecontroller::class,'logoutform']);
Route::match(['get','post'],'/addcart',[ecommercecontroller::class,'addcart']);
Route::get('/addcartlist',[ecommercecontroller::class,'addcartlist']);
Route::get('/removeaddcart/{id}',[ecommercecontroller::class,'removecart']);
Route::get('/addordernow',[ecommercecontroller::class,'addordernow']);
Route::match(['get','post'],'/addorderplace',[ecommercecontroller::class,'addorderplace']);
Route::get('/showorderlist',[ecommercecontroller::class,'showorderlist']);
Route::get('/removelist',[ecommercecontroller::class,'removelist']);
/////
Route::view('/vue/userface','laravel+vue/userface');
Route::view('/vue/showproduct','laravel+vue/userface');
Route::get('/vue/getproduct',[uploadfilecontroller::class,'getproducts','getcategorys']);
Route::get('/vue/getcates',[uploadfilecontroller::class,'getcategorys']);
Route::post('/vue/postid',[uploadfilecontroller::class,'postid']);
Route::view('/vue/showlogin','laravel+vue/userface');
Route::match(['post','get'],'/vue/login',[uploadfilecontroller::class,'login']);
Route::get('/vue/getuser',[uploadfilecontroller::class,'getuser']);
Route::get('/vue/ft/{id}',[uploadfilecontroller::class,'filter']);
Route::get('/vue/addcart',[uploadfilecontroller::class,'addcart']);
Route::view('/vue/viewcart','laravel+vue/userface');
Route::delete('/vue/delete/{id}',[uploadfilecontroller::class,'removecart']);
Route::get('/vue/logout',[uploadfilecontroller::class,'logout']);
Route::view('/vue/showinfo/{id}','laravel+vue/userface');
// Route::get('/vue/showinfo/{id}',[uploadfilecontroller::class,'showinfo']);
Route::get('/vue/viewinfo/{id}',[uploadfilecontroller::class,'viewinfo']);
Route::get('/vue/mice',[uploadfilecontroller::class,'getmice']);
Route::get('/vue/count',[uploadfilecontroller::class,'cartcount']);
Route::view('/vue/payment','laravel+vue/userface');
Route::get('/vue/totalprice',[uploadfilecontroller::class,'totalprice']);
Route::get('/vue/getitem',[uploadfilecontroller::class,'getitem']);
Route::delete('/vue/removeall',[uploadfilecontroller::class,'removeall']);
Route::match(['get','post'],'/vue/postaddress',[uploadfilecontroller::class,'postaddress']);
Route::view('/vue/myorder','laravel+vue/userface');
Route::get('/vue/getmyorders',[uploadfilecontroller::class,'getmyorders']);
Route::get('/vue/keyboard',[uploadfilecontroller::class,'getkeyboard']);

//myecommerce
Route::view('/ecommerce','laravel+vue/myecommercesite');
Route::view('/ecommerce/home','laravel+vue/myecommercesite');
Route::view('/ecommerce/register','laravel+vue/myecommercesite');
Route::view('/ecommerce/login','laravel+vue/myecommercesite');
Route::match(['get','post'],'/ecommerce/postadmin',[ecocontroller::class,'postadmin']);
Route::match(['get','post'],'/ecommerce/postlogin',[ecocontroller::class,'loginpost']);
Route::get('/ecommerce/logoutuser',[ecocontroller::class,'logoutuser']);
Route::get('/ecommerce/getusername',[ecocontroller::class,'getusername']);
Route::get('/ecommerce/category',function(){
    return view('laravel+vue/myecommercesite');
});
Route::match(['get','post'],'/ecommerce/postcategory',[ecocontroller::class,'postcategory']);
Route::get('/ecommerce/getcategory',[ecocontroller::class,'getcategory']);
Route::delete('/ecommerce/deletecategory/{id}',[ecocontroller::class,'deletecategory']);
Route::view('/ecommerce/product','laravel+vue/myecommercesite');
Route::match(['get','post'],'/ecommerce/addproduct',[ecocontroller::class,'addproduct']);
Route::put('/ecommerce/updatecategory/{id}',[ecocontroller::class,'updatecategory']);
Route::get('/ecommerce/getproducts',[ecocontroller::class,'getproducts']);
Route::delete('/ecommerce/deleteproduct/{id}',[ecocontroller::class,'deleteproduct']);
Route::get('/ecommerce/edit/{id}',[ecocontroller::class,'editpost']);
Route::put('/ecommerce/updatepost/{id}',[ecocontroller::class,'updatepost']);
Route::view('/ecommerce/edit','laravel+vue/myecommercesite');
Route::match(['get','post'],'/ecommerce/postsearch',[ecocontroller::class,'postsearch']);
Route::match(['get','post'],'/ecommerce/getsearch',[ecocontroller::class,'getsearch']);

//for myecommerce user
Route::view('/ecommerce/user/frame','laravel+vue/myecommercesiteuser');