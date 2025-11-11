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
    });
});