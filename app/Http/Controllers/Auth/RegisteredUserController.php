<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// THÊM 2 DÒNG NÀY
use App\Events\UserRegistered; // Event chào mừng
use App\Mail\WelcomeMail; // Mail chào mừng (nếu có)
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // 1. GỬI EMAIL CHÀO MỪNG (nếu có)
        Mail::to($user->email)->send(new WelcomeMail($user));

        // 3. GỬI EMAIL XÁC THỰC (mặc định Laravel)
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('page.index')->with('success', 'Đăng ký thành công! Chào mừng bạn đến với Gotto Job!');
    }
}