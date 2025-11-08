<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function index() {
        return view('employer.homeEmployer');
    }

    // Trang 1: thông tin nhà tuyển dụng
    public function infoEmployer()
    {
        return view('Employer.infoEmployer');
    }

    // Trang 2: đăng tin tuyển dụng
    public function create(Request $request)
    {
        // Nếu bạn muốn, có thể nhận dữ liệu từ trang trước qua query (GET)
        // $employerName = $request->input('name');
        return view('Employer.create');
    }

    // Xử lý lưu tin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required',
            'remote_type' => 'required',
            'salary' => 'required|numeric',
            'description' => 'required',
            'company_name' => 'required|string|max:255',
        ]);

        Job::create($validated + [
            'is_featured' => $request->boolean('is_featured'),
            'posted_at' => now(),
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'category' => $request->category,
        ]);

        return redirect()->route('Employer.create')->with('success', 'Đăng tin thành công!');
    }
}
