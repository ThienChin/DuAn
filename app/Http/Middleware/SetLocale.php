<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Lấy ngôn ngữ từ Session, nếu không có thì dùng ngôn ngữ mặc định của config
        $locale = Session::get('locale', config('app.locale'));
        
        // 2. Thiết lập ngôn ngữ cho ứng dụng
        App::setLocale($locale);

        return $next($request);
    }
}