<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AboutcvController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\AdminLogin;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;

// Route trang chào mừng
Route::get('/', function () {
    return view('welcome');
});

// Route cho danh sách công việc
Route::get('/list', [JobController::class, 'index'])->name('jobs.index');
Route::get('/list/{id}', [JobController::class, 'show'])->name('jobs.show');


Route::middleware('auth')->group(function () {
    // Route cho trang profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/jobs/{id}/apply', [JobController::class, 'applyForm'])->name('jobs.apply.form');
    Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::get('/apply/success', [JobController::class, 'applySuccess'])->name('jobs.apply.success');
});


Route::get('/home', [HomeController::class, 'index'])->name('page.index');
Route::get('/about', [HomeController::class, 'about'])->name('page.about');

Route::get('/send-mail', [MailController::class, 'send'])->name('send.mail');

Route::get('/contact', [ContactController::class, 'showForm'])->name('emails.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware(['auth'])->group(function () {

    // Route cho các chức năng CV và thông tin cá nhân
    Route::get('/about/create', [AboutcvController::class, 'create'])->name('create_cv.about');
    Route::post('/about/store', [AboutcvController::class, 'store'])->name('about.store');
    Route::get('/education/create', [EducationController::class, 'create'])->name('create_cv.education');
    Route::post('/education/store', [EducationController::class, 'store'])->name('education.store');
    Route::get('/experience/create', [ExperienceController::class, 'create'])->name('create_cv.experience');
    Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
    Route::get('/contract/create', [ContractController::class, 'create'])->name('create_cv.contract');
    Route::post('/contract/store', [ContractController::class, 'store'])->name('contract.store');
    Route::get('/resume/review', [ResumeController::class, 'review'])->name('create_cv.resume');

    Route::get('/upload', [UserController::class, 'showUpload'])->name('create_cv.upload');
    Route::post('/upload', [UserController::class, 'upload'])->name('upload.store');
    Route::get('/personal', [UserController::class, 'personalInfo'])->name('profile.personal');
});

// Route dành cho admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLogin::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
    });
});


// Bao gồm các route xác thực từ auth.php
    Route::delete('/profile/cv/{id}', [UserController::class, 'deleteCv'])->name('create_cv.delete');
    Route::get('/profile/cv/delete-confirm/{id}', [UserController::class, 'confirmDeleteCv'])->name('cv.delete.confirm.view');

