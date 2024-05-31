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
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\GeneralController;

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
    Route::post('change_password','change_password')->middleware('auth:sanctum')->name('change_password');
});
//--------------------------------Category Module------------------------------
Route::controller(CategoryController::class)->prefix('category')->group(function(){
    Route::get('/','index')->name('index');
});

//--------------------------------Category Product Module------------------------------
Route::controller(CategoryProductController::class)->prefix('category-product')->group(function(){
    Route::post('/','index')->name('index');
    Route::get('/special','special')->name('special');
    Route::post('/search','search')->name('search');
});

//--------------------------------User Favourites Module------------------------------
Route::controller(UserFavouriteController::class)->middleware('auth:sanctum')->prefix('user_favourite')->group(function(){
    Route::post('/','index')->name('index');
    Route::post('set_fav','set_fav')->name('set_fav');
    Route::post('del_fav','del_fav')->name('del_fav');
    
});

//--------------------------------shipping Module------------------------------
Route::controller(ShippingController::class)->prefix('shipping')->group(function(){
    Route::get('/','index')->name('index');
    Route::post('/','get_governorate')->name('get_governorate');
});

//--------------------------------payment Module------------------------------
Route::controller(PaymentMethodController::class)->prefix('payment')->group(function(){
    Route::get('/','index')->name('index');  
});

//--------------------------------discount codes Module-------------------------
Route::controller(DiscountCodesController::class)->prefix('discount_code')->group(function(){
    Route::post('/','index')->name('index');  
});

//--------------------------------user address Module-------------------------
Route::controller(UserAddressController::class)->middleware('auth:sanctum')->prefix('user_address')->group(function(){
    Route::post('/create','create')->name('create'); 
    Route::post('/','index')->name('index'); 
});

//--------------------------------general Module-------------------------
Route::controller(GeneralController::class)->group(function(){
    Route::get('/adv','adv')->name('adv'); 
    Route::get('/company_data','company_data')->name('company_data');
    Route::get('/contact_us','contact_us')->name('contact_us');
});
