<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;

class EducationController extends Controller
{
    public function create()
    {
        return view('create_cv.education');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school'      => 'required|string|max:255',
            'degree'      => 'nullable|string|max:100',
            'grad_date'   => 'nullable|date',
            'city'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Education::create($validated);

        return redirect()->route('create_cv.about')->with('success', 'Học vấn đã lưu!');
    }
}
