<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout']);


Route::post('action-tambah', [BelajarController::class, 'actionTambah']);
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('kurang', [BelajarController::class, 'kurang']);
    Route::get('kali', [BelajarController::class, 'kali']);
    Route::get('bagi', [BelajarController::class, 'bagi']);
});

// get, post, put, delete
Route::resource('dashboard', DashboardController::class)->middleware('auth');
Route::resource('categories', CategoriesController::class)->middleware('auth');
Route::resource('user', UsersController::class);


Route::group(['middleware' => 'auth'], function () {
    Route::resource('product', ProductController::class);
    Route::resource('pos', TransactionController::class);
});

Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);
