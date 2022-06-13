<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});

Route::prefix('users')->name('users.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add');
    Route::post('/add', [UserController::class, 'postAdd'])->name('post-add');
    Route::get('/update/{id}', [UserController::class, 'getUpdate'])->name('update');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('post-update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');

});

Route::prefix('auth')->name('auth.')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'userLogin'])->name('login-user');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'create'])->name('create');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('products')->name('products.')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
});