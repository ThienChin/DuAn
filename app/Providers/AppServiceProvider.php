<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Http\Middleware\SetLocale; // ✅ Import Middleware bạn đã tạo

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ THÊM LOGIC ĐĂNG KÝ MIDDLEWARE TẠI ĐÂY
        // Áp dụng SetLocale Middleware như một Global Middleware
        $this->app['router']->pushMiddlewareToGroup('web', SetLocale::class);
        
        // Hoặc có thể dùng URL::forceScheme('https') nếu bạn đang chạy trên HTTPS
        // if ($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}