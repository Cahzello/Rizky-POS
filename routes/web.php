<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [RoutingController::class, 'index'])->name('home');

Route::get('/login', [RoutingController::class, 'login'])->name('login');

Route::get('/register', [RoutingController::class, 'register'])->name('register');

Route::resource('/transactions', TransactionController::class);

Route::resource('/items', ItemController::class);

Route::resource('/category', CategoryController::class);

Route::resource('/customer', CustomerController::class);