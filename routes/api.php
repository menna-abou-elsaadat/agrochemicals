<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\UserFavouriteController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\DiscountCodesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//--------------------------------Auth Module------------------------------
Route::controller(AuthController::class)->group(function(){
    Route::post('signup','register')->name('register');
    Route::post('login','login')->name('login');
    Route::post('logout','logout')->middleware('auth:sanctum')->name('logout');
    Route::post('edit_user_data','edit_user_data')->middleware('auth:sanctum')->name('edit_user_data');
});
//--------------------------------Category Module------------------------------
Route::controller(CategoryController::class)->middleware('auth:sanctum')->prefix('category')->group(function(){
    Route::get('/','index')->name('index');
});

//--------------------------------Category Product Module------------------------------
Route::controller(CategoryProductController::class)->middleware('auth:sanctum')->prefix('category-product')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/special','special')->name('special');
});

//--------------------------------User Favourites Module------------------------------
Route::controller(UserFavouriteController::class)->middleware('auth:sanctum')->prefix('user_favourite')->group(function(){
    Route::get('/','index')->name('index');
    Route::post('set_fav','set_fav')->name('set_fav');
    Route::post('del_fav','del_fav')->name('del_fav');
    
});

//--------------------------------shipping Module------------------------------
Route::controller(ShippingController::class)->middleware('auth:sanctum')->prefix('shipping')->group(function(){
    Route::get('/','index')->name('index');  
});

//--------------------------------payment Module------------------------------
Route::controller(PaymentMethodController::class)->middleware('auth:sanctum')->prefix('payment')->group(function(){
    Route::get('/','index')->name('index');  
});

//--------------------------------discount codes Module------------------------------
Route::controller(DiscountCodesController::class)->middleware('auth:sanctum')->prefix('discount_code')->group(function(){
    Route::get('/','index')->name('index');  
});

