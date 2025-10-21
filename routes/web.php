<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ContactController;
<<<<<<< HEAD
=======
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AboutcvController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
>>>>>>> main
use App\Http\Controllers\JobController;

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// Trang Job
Route::get('/list', [JobController::class, 'index'])->name('jobs.index');
Route::get('/list/{id}', [JobController::class, 'show'])->name('jobs.show');

// Các route yêu cầu đăng nhập
=======
>>>>>>> main
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route cho danh sách công việc
    Route::get('/list', [JobController::class, 'index'])->name('jobs.index');
    
    // Route cho chi tiết công việc
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    
    // Route cho các hành động quản lý công việc
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

require __DIR__.'/auth.php';

<<<<<<< HEAD
// Trang thông tin cơ bản
Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/detail', [PageController::class, 'detail'])->name('page.detail');

// Demo gửi mail
Route::get('/send-mail', [MailDemoController::class, 'send'])->name('send.mail');

// Form liên hệ (Contact)
=======
Route::get('/home', [HomeController::class, 'index'])->name('page.index');
Route::get('/about', [HomeController::class, 'about'])->name('page.about');

// Xóa các route cũ của PageController nếu không còn cần
// Route::get('/list', [PageController::class, 'list'])->name('page.list');
// Route::get('/detail', [PageController::class, 'detail'])->name('page.detail');

Route::get('/send-mail', [MailController::class, 'send'])->name('send.mail');

>>>>>>> main
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

    Route::get('/upload', [UserController::class, 'showUpload'])->name('create_cv.upload');
    Route::post('/upload', [UserController::class, 'upload'])->name('upload.store');
    Route::get('/personal', [UserController::class, 'personalInfo'])->name('profile.personal');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'checkrole:admin'])
    ->name('admin.dashboard');