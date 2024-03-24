<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LoginForm;
use App\Livewire\User\UsersList;
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
