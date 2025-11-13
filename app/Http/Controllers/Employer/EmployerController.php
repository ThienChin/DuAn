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
        // 1. VALIDATION: Đã thêm các trường mới từ Model vào Validation
        $validated = $request->validate([
            // THÔNG TIN CÔNG VIỆC BẮT BUỘC
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'remote_type' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0', // Sử dụng nullable để cho phép 'Thương lượng' (input 0)
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            
            // YÊU CẦU CÔNG VIỆC (Tùy chọn)
            'experience' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|string|max:50',
            'required_skills' => 'nullable|string',
            
            // THÔNG TIN CÔNG TY & LIÊN HỆ
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'company_logo_url' => 'nullable|url|max:255',
            'jobs_images' => 'nullable|string', // Giữ là string (URL) nếu bạn không xử lý upload
        ]);

        // 2. TẠO JOB
        // Lấy tất cả các trường đã validate và thêm các trường mặc định/boolean
        Job::create(array_merge($validated, [
            'remote' => $request->boolean('remote'), // Xử lý checkbox remote
            'is_featured' => false, // Mặc định là false khi đăng mới
            'posted_at' => now(),
            'status' => 'pending', // Mặc định: Chờ duyệt
        ]));

        // 3. REDIRECT
        return redirect()
            ->route('employer.create')
            ->with('success', 'Tin đã gửi và đang chờ admin duyệt!');
    }
}