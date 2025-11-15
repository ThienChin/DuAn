<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Xác thực người dùng
        $request->authenticate();

        // 2. Cập nhật cột last_login_at
        if (Auth::check()) {
            $user = Auth::user();
            // Đảm bảo Job Model đã có cột 'last_login_at' trong database
            $user->update([
                'last_login_at' => Carbon::now()
            ]);
        }

        // 3. Khởi tạo lại session
        $request->session()->regenerate();

        // 4. Chuyển hướng
        return redirect()->intended(route('page.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('home');
    }
}