<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminsOnly;
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

Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/product',[ProductsController::class,'index']);
Route::get('/product/{product}',[ProductsController::class,'show']);
Route::post('/checkoutprocess',[ProductsController::class,'checkoutprocess']);



Route::group(['middleware'=>['auth:sanctum']],function(){
Route::post('/logout',[UserController::class,'logout']);

});
Route::middleware(['auth:sanctum', 'admin'])->group(function(){
Route::post('/product/store',[ProductsController::class,'store']);
Route::patch('/product/update/{product}',[ProductsController::class,'update']);
Route::delete('/product/delete/{product}',[ProductsController::class,'destroy']);

});  

//Route::get('/search/{prodcut:name}',[ProductsController::class,'show']);
Route::get('/product/{product}',[ProductsController::class,'show']);

// Route::middleware(['auth:sanctum', 'role:admin'])->get('/product/{product}',[] ); 
