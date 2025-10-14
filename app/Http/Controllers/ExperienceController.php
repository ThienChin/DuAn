<?php

namespace App\Http\Controllers;

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
            'company_name' => 'required|string|max:255',
            'position'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        Experience::create($validated);

        return redirect()->route('contract.create')->with('success', 'Kinh nghiệm đã lưu!');
    }
}
