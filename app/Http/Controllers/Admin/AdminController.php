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

    public function store(Request $request)
    {
        // Validate tất cả các trường có trong form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50', // Full-time/Part-time
            'level' => 'required|string|max:50',
            'description' => 'required|string',
            'remote_type' => 'nullable|string|max:50', // Thêm
            'category' => 'nullable|string|max:100', // Thêm
            'website' => 'nullable|url|max:255', // Thêm
            'company_description' => 'nullable|string', // Thêm
            'email' => 'nullable|email|max:255', // Thêm
            'phone' => 'nullable|string|max:20', // Thêm
            'is_featured' => 'nullable|boolean', // Thêm (sẽ là null hoặc 1)
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        
        // Xử lý Checkbox/Switch: Nếu không được check, 'is_featured' sẽ không tồn tại.
        // Thêm giá trị mặc định nếu trường này không gửi lên.
        $validated['is_featured'] = $request->has('is_featured'); 
        
        // Upload ảnh nếu có
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('jobs', 'public');
        }

        // Tạo job mới
        Job::create($validated);

        // Redirect về dashboard có thông báo
        return redirect()->route('admin.dashboard')
            ->with('success', 'Thêm Job mới thành công!');
    }
}
