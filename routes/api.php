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
Route::view('/myanmarexchange','/laravel+vue/uiux');

