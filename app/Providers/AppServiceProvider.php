<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // CHẠY CHO TẤT CẢ CÁC VIEW DÙNG LAYOUT main
        View::composer('layouts.main', function ($view) {
            $unreadNotifications = 0;
            $unreadMessages = 0;

            if (Auth::check()) {
                $unreadNotifications = Auth::user()->unreadNotifications()->count();
            }

            $view->with(compact('unreadNotifications', 'unreadMessages'));
        });
    }
}