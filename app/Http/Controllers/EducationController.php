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
            'school_name' => 'required|string|max:255',
            'degree'      => 'required|string|max:255',
            'field'       => 'required|string|max:255',
            'start_year'  => 'required|string|max:4',
            'end_year'    => 'nullable|string|max:4',
        ]);

        $validated['user_id'] = Auth::id();

        Education::create($validated);

        return redirect()->route('experience.create')->with('success', 'Học vấn đã lưu!');
    }
}
