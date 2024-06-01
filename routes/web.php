<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginForm;
use App\Livewire\User\UsersList;
use App\Livewire\Category\Index as category_index;
use App\Livewire\Product\Index as product_index;
use App\Livewire\PaymentMethod\Index as payment_method_index;
use App\Livewire\ShippingFees\Index as shipping_fees_index;
use App\Livewire\Company\Index as company_index;
use App\Livewire\Adv\Index as adv_index;
use App\Livewire\DiscountCodes\Index as discount_codes_index;
use App\Livewire\Contact\Index as contacts_index;
use App\Livewire\Dieses\Index as dieses_index;
use App\Livewire\Order\Index as order_index;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/', LoginForm::class)->name('login');
Route::get('/logout', [AuthController::class,'logout']);
/////////////////////////////////user feature////////////////////////////////////////////
Route::middleware('auth')->prefix('user')->group(function(){
    Route::get('/',UsersList::class)->name('users_list');
    
});
/////////////////////////category feature/////////////////////////////////////
Route::middleware('auth')->prefix('category')->group(function(){
    Route::get('/',category_index::class)->name('category_index');
    
});

/////////////////////////product feature/////////////////////////////////////
Route::middleware('auth')->prefix('product')->group(function(){
    Route::get('/{category_id?}/',product_index::class)->name('product_index');
    
});

/////////////////////////payment methods feature/////////////////////////////////////
Route::middleware('auth')->prefix('payment_methods')->group(function(){
    Route::get('/',payment_method_index::class)->name('payment_method_index');
    
});

/////////////////////////shipping fees feature/////////////////////////////////////
Route::middleware('auth')->prefix('shipping_fees')->group(function(){
    Route::get('/',shipping_fees_index::class)->name('shipping_fees_index');
    
});
/////////////////////////company data feature/////////////////////////////////////
Route::middleware('auth')->prefix('company')->group(function(){
    Route::get('/',company_index::class)->name('company_index');
    
});

/////////////////////////Adv feature/////////////////////////////////////
Route::middleware('auth')->prefix('Adv')->group(function(){
    Route::get('/',adv_index::class)->name('adv_index');
    
});
/////////////////////////Adv feature/////////////////////////////////////
Route::middleware('auth')->prefix('codes')->group(function(){
    Route::get('/',discount_codes_index::class)->name('discount_codes_index');
    
});
/////////////////////////contacts feature/////////////////////////////////////
Route::middleware('auth')->prefix('contact')->group(function(){
    Route::get('/',contacts_index::class)->name('contacts_index');
    
});

/////////////////////////dieses feature/////////////////////////////////////
Route::middleware('auth')->prefix('dieses')->group(function(){
    Route::get('/{id}',dieses_index::class)->name('dieses_index');
    
});

/////////////////////////order feature/////////////////////////////////////
Route::middleware('auth')->prefix('order')->group(function(){
    Route::get('/',order_index::class)->name('order_index');
    
});
