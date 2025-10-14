<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\About;

class AboutController extends Controller
{
    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'email'       => 'required|email|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        About::create($validated);

        return redirect()->route('education.create')->with('success', 'Thông tin cá nhân đã lưu!');
    }
}
