<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginForm;
use App\Livewire\User\UsersList;
use App\Livewire\Category\Index as category_index;
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
