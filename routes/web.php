<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccountController;

Route::group(['prefix' =>'account'], function() {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login', [AccountController::class, 'post_login']);
    // Phương thức get hiển thị form register
    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    //Phương thức post để thực hiện register khi submit form
    Route::post('/register', [AccountController::class, 'post_register']);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/list', [PageController::class, 'list'])->name('page.list');
Route::get('/detail', [PageController::class, 'detail'])->name('page.detail');
