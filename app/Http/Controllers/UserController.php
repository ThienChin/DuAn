<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister() {
        return view('register');
    }

    // Lưu thông tin đăng ký
    public function register(Request $request) {
    $user = Auth::user();
    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
    ]);
    Session::put('user', [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
    ]);
    return redirect('/upload');
}

    // Hiển thị form upload
    public function showUpload() {
        return view('upload');
    }

    // Lưu file upload
    public function upload(Request $request) {
        $filePath = null;
        if ($request->hasFile('pdfFile')) {
            $file = $request->file('pdfFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $filePath = 'uploads/' . $fileName;
        }

        $user = Session::get('user');
        $user['cv_path'] = $filePath;
        Session::put('user', $user);

        return redirect('/personal');
    }

    // Trang thông tin cá nhân
    public function personalInfo()
    {
    $user = Session::get('user') ?? Auth::user()->toArray();
    if (!$user) {
        return redirect('/register')->with('error', 'Vui lòng đăng ký trước.');
    }
    return view('profile.personal', compact('user'));
    }

    // public function personal()
    // {
    //     return view('personal');
    // }
}
