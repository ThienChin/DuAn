<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;

class EducationController extends Controller
{
    /**
     * Hiển thị form nhập thông tin Education
     */
    public function create()
    {
        return view('create_cv.education'); // file: resources/views/education.blade.php
    }

    /**
     * Lưu thông tin Education vào database
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validated = $request->validate([
            'school'      => 'required|string|max:255',
            'degree'      => 'nullable|string|max:100',
            'grad_date'   => 'nullable|date',
            'city'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Lưu vào DB
        Education::create($validated);

        // Sau khi lưu thành công, quay lại form kèm thông báo
        return redirect()->route('create_cv.about')->with('success', 'Education information saved successfully!');
    }
}
