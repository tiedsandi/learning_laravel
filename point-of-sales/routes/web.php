<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('belajar', [BelajarController::class, 'index'] );
Route::get('tambah', [BelajarController::class, 'tambah'] );
Route::get('kurang', [BelajarController::class, 'kurang'] );
Route::get('kali', [BelajarController::class, 'kali'] );
Route::get('bagi', [BelajarController::class, 'bagi'] );
Route::get('login', [LoginController::class, 'login'] );


Route::post('action-tambah', [BelajarController::class, 'actionTambah'] );
Route::post('action-login', [LoginController::class, 'actionLogin'] );

// get, post, put, delete
Route::resource('dashboard', DashboardController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('user', UsersController::class);