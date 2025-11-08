<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionEmployerController extends Controller
{
    /**
     * Hiển thị view đăng nhập Nhà Tuyển Dụng.
     */
    public function create(): View
    {
        return view('auth.loginEmployer');
    }

    /**
     * Xử lý yêu cầu đăng nhập Nhà Tuyển Dụng.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Xác thực bằng Guard 'employer'
        // Bạn cần đảm bảo đã cấu hình guard 'employer' trong config/auth.php
        if (! Auth::guard('employer')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // Xác thực thất bại
            return back()->withInput($request->only('email', 'remember'))
                        ->withErrors(['email' => 'Thông tin đăng nhập Nhà Tuyển Dụng không hợp lệ.']);
        }

        $request->session()->regenerate();

        // 2. Chuyển hướng đến dashboard riêng của Employer
        // Sử dụng route() hoặc đường dẫn tuyệt đối, giống như Controller User mặc định
        // *Giả định bạn đã đặt tên cho route dashboard của Employer là 'employer.dashboard'*
        return redirect()->intended(route('Employer.homeEmployer', absolute: false));
    }

    /**
     * Hủy phiên làm việc (Đăng xuất) của Nhà Tuyển Dụng.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('employer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Chuyển hướng về trang chủ hoặc trang đăng nhập Employer
        return redirect('Employer.homeEmployer'); 
    }
}