<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // ✨ ĐÃ THÊM: Import Auth Facade

class RegisteredEmployerController extends Controller
{
    /**
     * Hiển thị trang đăng ký nhà tuyển dụng.
     */
    public function create(): View
    {
        // Trỏ đến view đăng ký mới
        return view('auth.registerEmployer'); // Đã sửa tên view chuẩn: register-employer
    }

    /**
     * Xử lý yêu cầu đăng ký nhà tuyển dụng.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate dữ liệu
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Employer::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Nam,Nữ'],
            'phone' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            // Các trường còn lại trong model Employer.php
            'position' => ['nullable', 'string', 'max:255'], 
            'address' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:255', 'url'],
            'description' => ['nullable', 'string'],
        ]);

        // 2. Tạo bản ghi Employer
        $employer = Employer::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address ?? null, // Gán null nếu không có giá trị
            'position' => $request->position ?? null,
            'website' => $request->website ?? null,
            'description' => $request->description ?? null,
            'password' => Hash::make($request->password), 
            'gender' => $request->gender, 
        ]);


        // 3. ✨ THAY ĐỔI LỚN: Tự động đăng nhập Employer ngay sau khi đăng ký
        Auth::guard('employer')->login($employer); 
        // ----------------------------------------------------------------------


        // 4. Chuyển hướng đến Dashboard của Employer
        return redirect()->route('employer.dashboard')
                         ->with('success', 'Đăng ký thành công! Bạn đã được đăng nhập.');
    }
}