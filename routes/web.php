<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MailDemoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\create_cvController;

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


Route::get('/contract', [create_cvController::class, 'contract'])->name('create_cv.contract');
Route::post('/contract', [ContractControllerController::class, 'store'])->name('contract.store');
Route::get('/experience', [create_cvController::class, 'experience'])->name('create_cv.experience');
Route::get('/education', [create_cvController::class, 'education'])->name('create_cv.education');
Route::get('/aboutcv', [create_cvController::class, 'aboutcv'])->name('create_cv.about');
Route::get('/resume', [create_cvController::class, 'resume'])->name('create_cv.resume');