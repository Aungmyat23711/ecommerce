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
use App\Http\Controllers\entertainmentController;
use App\Http\Controllers\ChatController;

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
Route::get('/user/index',[inertiacontroller::class,'index'])->name('user.index');

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
Route::view('/ecommerce/photo','laravel+vue/myecommercesite');
Route::match(['get','post'],'/ecommerce/postsearch',[ecocontroller::class,'postsearch']);
Route::match(['get','post'],'/ecommerce/getsearch',[ecocontroller::class,'getsearch']);
Route::get('/ecommerce/getprophoto',[ecocontroller::class,'getprophoto']);
Route::get('/ecommerce/eachproduct/{id}',[ecocontroller::class,'eachproduct']);
Route::view('/ecommerce/addphoto/{id}','laravel+vue/myecommercesite');
Route::get('/ecommerce/countphoto/{id}',[ecocontroller::class,'countphoto']);
Route::match(['get','post'],'/ecommerce/uploadphoto',[ecocontroller::class,'uploadphoto']);
Route::get('/ecommerce/getphoto/{id}',[ecocontroller::class,'getphoto']);
Route::delete('/ecommerce/deletephoto/{id}',[ecocontroller::class,'deletephoto']);

//for myecommerce user
Route::view('/ecommerce/user/frame','laravel+vue/myecommercesiteuser');
Route::view('/ecommerce/user/home','laravel+vue/myecommercesiteuser');
Route::get('/ecommerce/user/getallproducts',[ecocontroller::class,'getallproducts']);
Route::get('/ecommerce/user/searchallproducts',[ecocontroller::class,'searchallproducts']);
Route::get('/ecommerce/user/getcategory',[ecocontroller::class,'getusercategory']);
Route::get('/ecommerce/user/filter/get',[ecocontroller::class,'getproductbycat']);
Route::view('/ecommerce/user/info/{id}','laravel+vue/myecommercesiteuser');
Route::view('/ecommerce/user/register','laravel+vue/myecommercesiteuser');
Route::view('/ecommerce/user/login','laravel+vue/myecommercesiteuser');
Route::get('/ecommerce/user/getinfo/{id}',[ecocontroller::class,'getinfo']);
Route::match(['get','post'],'/ecommerce/user/addregister',[ecocontroller::class,'registeruser']);
Route::match(['get','post'],'/ecommerce/user/addlogin',[ecocontroller::class,'addlogin']);
Route::view('/ecommerce/user/exchange','laravel+vue/myecommercesiteuser');
Route::match(['get','post'],'/ecommerce/user/postdetails',[ecocontroller::class,'postdetails']);
Route::view('/ecommerce/user/cart','laravel+vue/myecommercesiteuser');
Route::get('/ecommerce/user/getcount',[ecocontroller::class,'getcount']);
Route::get('/ecommerce/user/cartitem/{id}',[ecocontroller::class,'getcartitem']);
Route::get('/ecommerce/user/getall',[ecocontroller::class,'getall']);
Route::delete('/ecommerce/user/deletecart/{id}',[ecocontroller::class,'deletecart']);
Route::get('/ecommerce/user/getcartitem/{id}',[ecocontroller::class,'getcartitems']);
Route::view('/ecommerce/user/submitorder','laravel+vue/myecommercesiteuser');
Route::match(['get','post'],'/ecommerce/user/ordernow',[ecocontroller::class,'ordernow']);
Route::get('/ecommerce/user/getmyorder/{id}',[ecocontroller::class,'myorder']);
Route::get('/ecommerce/user/getphoto/{id}',[ecocontroller::class,'getphotos']);

// for Anime
Route::view('/animeframe','laravel+vue/uiux');
Route::view('/','laravel+vue/uiux');
Route::view('/animeframe/myprojects','laravel+vue/uiux');
Route::view('/animeframe/team','laravel+vue/uiux');
Route::match(['get','post'],'/createdata',[entertainmentController::class,'createdata']);
Route::get('/getdata',[entertainmentController::class,'getdata']);
Route::delete('/deleteitem/{id}',[entertainmentController::class,'deleteitem']);
Route::view('/animeframe/register','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/register/add',[entertainmentController::class,'teamregister']);
Route::view('/animeframe/login','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/login/accept',[entertainmentController::class,'login']);
Route::put('/animeframe/editdata/{id}',[entertainmentController::class,'edit']);
Route::get('/animeframe/teamlist',[entertainmentController::class,'getTeam']);
Route::get('/animeframe/getproject/{id}',[entertainmentController::class,'getproject']);
Route::view('/animeframe/myprojects/viewseason/{id}','laravel+vue/uiux');
Route::get('/animeframe/getdata/{id}',[entertainmentController::class,'getanimedata']);
Route::match(['get','post'],'/animeframe/addseason/{id}',[entertainmentController::class,'addseason']);
Route::get('/animeframe/getseason/{id}',[entertainmentController::class,'getseason']);
Route::view('/animeframe/myprojects/viewseason/{mid}/viewepisode/{sid}','laravel+vue/uiux');
Route::get('/animeframe/geteachseason/{id}',[entertainmentController::class,'geteachseason']);
Route::match(['get','post'],'/animeframe/addepisode',[entertainmentController::class,'addepisode']);
Route::get('/animeframe/getepisode/{id}',[entertainmentController::class,'getepisode']);
Route::match(['get','post'],'/animeframe/addtype',[entertainmentController::class,'addtype']);
Route::get('/animeframe/getType',[entertainmentController::class,'getType']);

//for aseriesworld
Route::view('/aframe','laravel+vue/aseriesworld');


//for chat
Route::view('/animeframe/chatpage','laravel+vue/chat');
Route::match(['get','post'],'/animeframe/chatpage/send',[ChatController::class,'chatting']);
Route::match(['get','post'],'/animeframe/teamlist/addprivate',[ChatController::class,'addprivate']);
Route::view('/animeframe/privatechat','laravel+vue/uiux');
Route::match(['get','post'],'/animeframe/addroom',[ChatController::class,'addroom']);
Route::get('/animeframe/getroom/{id}',[ChatController::class,'getroom']);
Route::get('/animeframe/getroombyid/{id}',[ChatController::class,'getroombyid']);
Route::get('/animeframe/teamchat/{id}',[ChatController::class,'getTeam']);
Route::match(['get','post'],'/animeframe/senduser',[ChatController::class,'senduser']);
Route::get('/animeframe/getroomuser/{id}',[ChatController::class,'getroomuser']);
Route::view('/animeframe/admin/chatting','laravel+vue/uiux');