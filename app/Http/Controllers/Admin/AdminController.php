<?php
namespace App\Http\Controllers\Admin;


use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị form tạo job mới
    public function create()
    {
        return view('admin.create');
    }

    // Xử lý lưu job mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:jobs,slug',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Nếu có upload ảnh
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('jobs', 'public');
            $validated['image'] = $path;
        }

        // Tạo mới job
        Job::create($validated);

        // Quay lại trang danh sách hoặc dashboard kèm thông báo
        return redirect()->route('admin.dashboard')->with('success', 'Thêm Job mới thành công!');
    }
}
