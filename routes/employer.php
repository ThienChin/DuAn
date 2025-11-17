<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\EmployerController;


    Route::prefix('employer')->name('employer.')->group(function () {

        // ✅ Trang giới thiệu (không cần login)
        Route::get('/intro', [EmployerController::class, 'intro'])->name('intro');

        // ✅ Route BẮT BUỘC login employer
        Route::middleware('auth:employer')->group(function () {
            Route::get('/create', [EmployerController::class, 'create'])->name('create');
            Route::post('/store', [EmployerController::class, 'store'])->name('store');
            Route::get('/my-jobs', [EmployerController::class, 'myJobs'])->name('myJobs');
            Route::get('/dasboard', [EmployerController::class, 'dashboard'])->name('dashboard');

            // ✨ ROUTE CHỈNH SỬA VÀ CẬP NHẬT TIN TUYỂN DỤNG ✨
            Route::get('/jobs/{job}/edit', [EmployerController::class, 'edit'])->name('editJob');
            Route::put('/jobs/{job}', [EmployerController::class, 'update'])->name('updateJob');
            // ✨ ROUTE XÓA (Cần thiết cho nút hành động trong myJobs) ✨
            Route::delete('/jobs/{job}', [EmployerController::class, 'destroy'])->name('destroyJob');

            // ✨ ROUTE MỚI: CÀI ĐẶT
            Route::get('/settings/company', [EmployerController::class, 'showCompanyInfo'])->name('companyInfo');
            Route::put('/settings/company', [EmployerController::class, 'updateCompanyInfo'])->name('updateCompanyInfo');

            Route::get('/settings/account', [EmployerController::class, 'showAccountSettings'])->name('accountSettings');
            Route::put('/settings/account', [EmployerController::class, 'updateAccountSettings'])->name('updateAccountSettings');
        });
    });
    Route::middleware(['auth:employer'])->prefix('employer')->name('employer.')->group(function () {
        // ✅ 1. Quản lý ứng viên
    Route::get('/applications', [EmployerController::class, 'showApplication'])->name('history');
        
    // [GET] Hiển thị form nhập chi tiết (dùng cho cả accepted/rejected)
    Route::get('applications/{application}/form/{action}', [EmployerController::class, 'showApplicationForm'])
        ->name('application_form'); 

    // [PUT] Xử lý gửi form và gửi email (Dùng chung cho cả accepted/rejected)
    Route::put('/applications/{application}/send-decision', [EmployerController::class, 'sendDecision'])->name('send_decision');

        // ✅ 2. Xem/Tải CV
        // Sử dụng route model binding cho JobApplication
        Route::get('/applications/{application}/view-cv', [EmployerController::class, 'viewCv'])->name('viewCV');
        Route::post('/candidate/save/{user}', [EmployerController::class, 'saveCandidate'])->name('candidate.save');
    });

    Route::put('applications/{application}/status', [EmployerController::class, 'updateApplicationStatus'])
        ->name('employer.application.update_status');