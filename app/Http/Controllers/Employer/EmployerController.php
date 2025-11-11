<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;


class EmployerController extends Controller
{
    public function intro()
    {
        return view('Employer.intro');
    }

    public function dashboard()
    {
        return view('Employer.dashboard');
    }


    public function myJobs()
    {
        $jobs = Job::where->where('user_id', auth()->id())->latest()->get();

        return view('Employer.myJob', compact('jobs'));
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

    public function store(Request $request)
    {
        // 1. VALIDATION: Thêm các trường cần thiết từ form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|in:Internship,Junior,Senior', // Kiểm tra giá trị enum
            'remote_type' => 'required|in:Full Time,Contract,Part Time', // Kiểm tra giá trị enum
            
            // Xử lý salary: Nếu là 'Thương lượng', giá trị có thể là null/0.
            'salary' => 'nullable|numeric|min:0', // Đặt nullable vì có thể là "Thương lượng"
            
            'description' => 'required|string',
            'category' => 'required|string|max:255', // Đã thêm category
            
            // Các trường thông tin công ty/liên hệ
            'company_name' => 'required|string|max:255', // Thêm validation cho các trường này
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            
            // Nếu bạn thêm các trường này vào Job Model:
            // 'job_code' => 'nullable|string|max:50',
            // 'quantity' => 'nullable|integer|min:1',
            // 'remote' => 'boolean', // Laravel tự xử lý checkbox nếu name có mặt
        ]);

        // 2. TẠO JOB: Lấy tất cả các trường đã validate và thêm các trường mặc định/không validate
        Job::create(array_merge($validated, [
            // Trường boolean/enum (chỉ lưu giá trị)
            'remote' => $request->boolean('remote'), // Xử lý checkbox remote
            'is_featured' => false, // Luôn false khi đăng mới
            
            // Trường timestamp/status
            'posted_at' => now(),
            'status' => 'pending', // Mặc định: Chờ duyệt
            
            // Nếu bạn có các trường khác trong form:
            // 'job_code' => $request->job_code,
            // 'quantity' => $request->quantity,
        ]));

        // 3. REDIRECT: Trả về trang thông báo
        return redirect()
            ->route('employer.create') // Sửa lỗi chính tả thành 'employer.create' (thường là chữ thường)
            ->with('success', 'Tin đã gửi và đang chờ admin duyệt!');
    }
}