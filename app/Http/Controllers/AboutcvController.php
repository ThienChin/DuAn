<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aboutcv;

class AboutcvController extends Controller
{
    public function create()
    {
        return view('create_cv.about');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'summary' => 'required|string|max:2000',
            'skill'   => 'required|string|max:100',
            'level'   => 'required|in:Beginner,Experienced,Expert',
        ]);

        $validated['user_id'] = Auth::id();

        Aboutcv::create($validated);

        return redirect()->route('create_cv.resume')->with('success', 'Thông tin cá nhân đã lưu!');
    }
}
