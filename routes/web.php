<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MailDemoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AboutcvController;
use App\Http\Controllers\ResumeController;


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
Route::get('/home', [HomeController::class, 'index'])->name('page.index');
Route::get('/about', [HomeController::class, 'about'])->name('page.about');
Route::get('/list', [PageController::class, 'list'])->name('page.list');
Route::get('/detail', [PageController::class, 'detail'])->name('page.detail');

// Demo gửi mail
Route::get('/send-mail', [MailController::class, 'send'])->name('send.mail');

// Form liên hệ (Contact)
Route::get('/contact', [ContactController::class, 'showForm'])->name('emails.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::middleware(['auth'])->group(function () {
    Route::get('/about/create', [AboutcvController::class, 'create'])->name('create_cv.about');
    Route::post('/about/store', [AboutcvController::class, 'store'])->name('about.store');

    Route::get('/education/create', [EducationController::class, 'create'])->name('create_cv.education');
    Route::post('/education/store', [EducationController::class, 'store'])->name('education.store');

    Route::get('/experience/create', [ExperienceController::class, 'create'])->name('create_cv.experience');
    Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');

    Route::get('/contract/create', [ContractController::class, 'create'])->name('create_cv.contract');
    Route::post('/contract/store', [ContractController::class, 'store'])->name('contract.store');

    Route::get('/resume/review', [ResumeController::class, 'review'])->name('create_cv.resume');

    Route::get('/upload', [UploadController::class, 'upload'])->name('create_cv.upload');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

}); 