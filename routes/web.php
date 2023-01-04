<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'indexLogin'])->name('indexLogin');
Route::get('/register', [LoginController::class, 'indexRegister'])->name('indexRegister');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/register', [LoginController::class, 'storeUser'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('product', ProductController::class)->middleware('auth');
