<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLogin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminUserController;


// Route dành cho admin (Mở khối prefix)
Route::prefix('admin')->group(function () {
    
    // Routes Login & Logout không cần middleware
    Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLogin::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

    // Routes cần middleware 'admin'
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Route tạo job cũ (từ AdminController)
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/create', [AdminController::class, 'store'])->name('admin.store');
        
        // ✨ ROUTES QUẢN LÝ TIN TUYỂN DỤNG
        // Route chính: Xử lý tất cả các trạng thái (pending, approved, all)
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index'); 
        
        // Chi tiết tin (Dùng show)
        Route::get('/jobs/{job}/show', [AdminJobController::class, 'show'])->name('admin.jobs.show'); 
        
        // Hành động duyệt/từ chối (Giữ nguyên POST, nhưng action trỏ về index mới)
        Route::post('/jobs/{job}/approve', [AdminJobController::class, 'approve'])->name('admin.jobs.approve');
        Route::post('/jobs/{job}/reject', [AdminJobController::class, 'reject'])->name('admin.jobs.reject');

        // routes/admin.php (Thêm vào khối middleware('admin')->group)

        // GET: Hiển thị form chỉnh sửa (điền sẵn dữ liệu)
        Route::get('/jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('admin.jobs.edit');

        // PUT: Xử lý việc cập nhật dữ liệu
        Route::put('/jobs/{job}', [AdminJobController::class, 'update'])->name('admin.jobs.update');

        // DELETE: Xóa vĩnh viễn tin tuyển dụng
        Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('admin.jobs.destroy');

        // ✨ ROUTES QUẢN LÝ NGƯỜI DÙNG (USERS)
        Route::prefix('users')->group(function () {
            // Nhà tuyển dụng
            Route::get('/employers', [AdminUserController::class, 'employersIndex'])->name('admin.users.employers');

            Route::get('/employers/{employer}', [AdminUserController::class, 'employerShow'])->name('admin.users.employer_show');

            Route::get('/jobs/employer/{id}', [AdminJobController::class, 'employerJobsIndex'])->name('admin.jobs.employer_index');
            
            
            // Ứng viên
            Route::get('/candidates', [AdminUserController::class, 'candidatesIndex'])->name('admin.users.candidates');

            

            // ✨ ROUTE XEM CHI TIẾT CANDIDATE
            Route::get('/candidates/{user}', [AdminUserController::class, 'candidateShow'])->name('admin.users.candidate_show');

            Route::put('update/{user}', [AdminUserController::class, 'update'])->name('update');

            // Route cho chức năng Khóa/Mở khóa (Chúng ta sẽ xây dựng sau)
            // Route::post('/{model}/{id}/toggle-ban', [AdminUserController::class, 'toggleBan'])->name('admin.users.toggle_ban');
        });
    });


});