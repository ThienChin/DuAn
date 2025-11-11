<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Chuyển đổi ngôn ngữ và lưu vào session.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLanguage($locale)
    {
        // 1. Kiểm tra ngôn ngữ hợp lệ
        if (!in_array($locale, ['en', 'vi'])) {
            $locale = config('app.locale'); // Nếu không hợp lệ, dùng mặc định
        }

        // 2. Lưu ngôn ngữ vào Session
        Session::put('locale', $locale);

        // 3. Chuyển hướng về trang trước đó
        return redirect()->back();
    }
}