<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLogin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;


// Route dành cho admin (Mở khối prefix)
Route::prefix('admin')->group(function () {
    
    // Routes Login & Logout không cần middleware
    Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLogin::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

    // Routes cần middleware 'admin' (MỌI THỨ CẦN BẢO VỆ ĐỀU Ở TRONG KHỐI NÀY)
    Route::middleware('admin')->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Route tạo job cũ (từ AdminController)
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
        
        // ✨ ROUTES QUẢN LÝ TIN TUYỂN DỤNG
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index'); 
        Route::get('/jobs/{job}/show', [AdminJobController::class, 'show'])->name('admin.jobs.show'); 
        Route::post('/jobs/{job}/approve', [AdminJobController::class, 'approve'])->name('admin.jobs.approve');
        Route::post('/jobs/{job}/reject', [AdminJobController::class, 'reject'])->name('admin.jobs.reject');
        Route::get('/jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');
        Route::put('/jobs/{job}', [AdminJobController::class, 'update'])->name('admin.jobs.update');
        Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('admin.jobs.destroy');

        Route::put('jobs/{job}/status', [AdminJobController::class, 'updateStatus'])->name('admin.jobs.update_status');

        // ✨ ROUTES QUẢN LÝ NGƯỜI DÙNG (USERS)
        Route::prefix('users')->group(function () {
            // Nhà tuyển dụng
            Route::get('/employers', [AdminUserController::class, 'employersIndex'])->name('admin.users.employers');
            Route::get('/employers/{employer}', [AdminUserController::class, 'employerShow'])->name('admin.users.employer_show');
            Route::get('/jobs/employer/{id}', [AdminJobController::class, 'employerJobsIndex'])->name('admin.jobs.employer_index');
            
            
            // Ứng viên
            Route::get('/candidates', [AdminUserController::class, 'candidatesIndex'])->name('admin.users.candidates');
            Route::get('/candidates/{user}', [AdminUserController::class, 'candidateShow'])->name('admin.users.candidate_show');
            Route::get('edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
            Route::put('update/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
            Route::get('users/applications/{application}', [AdminUserController::class, 'applicationShow'])
                    ->name('admin.users.applications.show');
            
        });
        
        // ✨ ROUTES QUẢN LÝ DANH MỤC (CATEGORIES)
        Route::prefix('categories')->name('admin.categories.')->group(function () {

            // [GET] Hiển thị danh sách giá trị theo loại danh mục (INDEX)
            Route::get('{key}', [AdminCategoryController::class, 'index'])->name('index'); 

            // [POST] Xử lý lưu (Dùng chung cho Create và Update)
            Route::post('store', [AdminCategoryController::class, 'store'])->name('store');

            Route::put('{category}', [AdminCategoryController::class, 'update'])->name('update');

            // [DELETE] Xóa một danh mục
            Route::delete('{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });
        
    }); // KẾT THÚC MIDDLEWARE ADMIN
});