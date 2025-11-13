<?php

require __DIR__.'/auth.php';
require __DIR__.'/employer.php';
require __DIR__.'/admin.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ContractController;
use App\Http\Controllers\User\ExperienceController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\AboutcvController;
use App\Http\Controllers\User\ResumeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UploadController;



// Trang chào mừng
Route::get('/', function () {
    return view('welcome');
});

// Route không yêu cầu xác thực
Route::get('/home', [HomeController::class, 'index'])->name('page.index');
Route::get('/about', [HomeController::class, 'about'])->name('page.about');
Route::get('/contact', [ContactController::class, 'showForm'])->name('emails.contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Danh sách công việc
Route::get('/list', [JobController::class, 'index'])->name('jobs.list');
Route::get('/list/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Apply job
    Route::get('/jobs/{id}/apply', [JobController::class, 'applyForm'])->name('jobs.apply.form');
    Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::get('/apply/success', [JobController::class, 'applySuccess'])->name('jobs.apply.success');
});


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

    Route::delete('/profile/cv/{id}', [UserController::class, 'deleteCv'])->name('create_cv.delete');
    Route::get('/profile/cv/delete-confirm/{id}', [UserController::class, 'confirmDeleteCv'])->name('cv.delete.confirm.view');
});



Route::get('lang/{locale}', [LanguageController::class, 'switchLanguage'])
    ->name('language.switch');


