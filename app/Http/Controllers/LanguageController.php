<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        // ... (Giữ nguyên phần kiểm tra ngôn ngữ hợp lệ)

        // 2. Lưu ngôn ngữ vào Session
        Session::put('locale', $locale);

        // ✅ THÊM DÒNG DEBUG NÀY VÀO ĐÂY
        dd(Session::get('locale')); 
        
        // 3. Chuyển hướng về trang trước đó
        return redirect()->back();
    }
}