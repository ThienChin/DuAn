<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    /**
     * Hiển thị form nhập kinh nghiệm.
     */
    public function show()
    {
        return view('create_cv.experience'); // trỏ tới resources/views/experience.blade.php
    }

    /**
     * Xử lý và lưu dữ liệu kinh nghiệm vào database.
     */
    public function store(Request $request)
    {
        // ✅ Kiểm tra dữ liệu đầu vào
        $validated = $request->validate([
            'job_title'   => 'required|string|max:255',
            'employer'    => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'city'        => 'nullable|string|max:100',
            'description' => 'nullable|string|max:2000',
        ]);

        // ✅ Lưu vào database
        Experience::create($validated);

        // ✅ Chuyển hướng tới bước tiếp theo (ví dụ Education)
        return redirect()->route('create_cv.education')->with('success', 'Experience saved successfully!');
    }
}
