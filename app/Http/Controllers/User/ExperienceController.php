<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function create()
    {
        return view('create_cv.experience');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title'   => 'required|string|max:255',
            'employer'    => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'city'        => 'nullable|string|max:100',
            'description' => 'nullable|string|max:2000',
        ]);

        $validated['user_id'] = Auth::id();

        Experience::create($validated);

        return redirect()->route('create_cv.education')->with('success', 'Kinh nghiệm đã lưu!');
    }
}
