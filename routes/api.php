<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'products'],function(){
  Route::get('/',[ProductController::class,'index']);
  Route::post('/',[ProductController::class,'store']);
  Route::get('/{id}',[ProductController::class,'show']);
  Route::delete('/{id}',[ProductController::class,'destroy']);
  Route::put('/{id}',[ProductController::class,'update']);
});



