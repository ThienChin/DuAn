<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MailDemoController;
use App\Http\Controllers\ContactController;

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Các route yêu cầu đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Trang thông tin cơ bản
Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/list', [PageController::class, 'list'])->name('page.list');
Route::get('/detail', [PageController::class, 'detail'])->name('page.detail');

// Demo gửi mail
Route::get('/send-mail', [MailController::class, 'send'])->name('send.mail');

// Form liên hệ (Contact)
Route::get('/contact', [ContactController::class, 'showForm'])->name('emails.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// trang admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
