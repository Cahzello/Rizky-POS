<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
    
    Route::post('/register', [AuthController::class, 'register']);
    
});

Route::middleware('auth')->group(function () {

    Route::get('/', [RoutingController::class, 'index'])->name('home');

    Route::get('/home', [RoutingController::class, 'index'])->name('home');

    Route::resource('/transactions', TransactionController::class);

    Route::resource('/items', ItemController::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/customer', CustomerController::class);
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/profile/username', [ProfileController::class, 'username'])->name('username');

    Route::post('/profile/email', [ProfileController::class, 'email'])->name('email');

    Route::post('/profile/password', [ProfileController::class, 'password'])->name('password');

    Route::post('/profile/avatar', [ProfileController::class, 'upload'])->name('avatar');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
