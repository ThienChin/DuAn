<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // ✨ ĐÃ THÊM: Sử dụng Facade Storage



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
        // Sử dụng Auth::guard('employer') để lấy ID của nhà tuyển dụng đã đăng nhập
        $employerId = Auth::guard('employer')->id(); 

        // Tải các Job, đồng thời tải luôn mối quan hệ với Category để tránh N+1 query
        $jobs = Job::where('employer_id', $employerId)
                    ->with(['locationItem', 'levelItem']) // Tải Location và Level Category
                    ->latest() // Sắp xếp theo ngày đăng mới nhất
                    ->get();

        return view('Employer.myJob', compact('jobs'));
    }


    // Trang 1: thông tin nhà tuyển dụng
    public function infoEmployer()
    {
        return view('Employer.infoEmployer');
    }

    public function create(Request $request)
    {
        // 1. Lấy tất cả danh mục và nhóm theo key để truyền sang View
        $categoriesData = Category::all()->groupBy('key');

        $data = [
            // Các danh mục chính
            'locations' => $categoriesData->get('location', collect())->sortBy('order'),
            'levels' => $categoriesData->get('level', collect())->sortBy('order'),
            'categories' => $categoriesData->get('category', collect())->sortBy('order'),
            'remote_types' => $categoriesData->get('remote_type', collect())->sortBy('order'),
            
            // Các danh mục yêu cầu (tùy chọn)
            'experiences' => $categoriesData->get('experience', collect())->sortBy('order'),
            'degrees' => $categoriesData->get('degree', collect())->sortBy('order'),
            'genders' => $categoriesData->get('gender', collect())->sortBy('order'),
        ];
        
        // 2. Truyền dữ liệu sang view Employer.create
        return view('Employer.create', $data);
    }

    /**
     * Xử lý việc lưu trữ tin tuyển dụng mới.
     */
    public function store(Request $request)
{
    // --- BƯỚC 1: VALIDATION ---
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'remote_type' => 'required|string|max:255',
        'description' => 'required|string',
        'company_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',

        'salary' => 'nullable|numeric|min:0',
        'remote' => 'nullable|boolean',
        'experience' => 'nullable|string|max:255',
        'degree' => 'nullable|string|max:255',
        'gender' => 'nullable|string|max:50',
        'age' => 'nullable|string|max:50',
        'required_skills' => 'nullable|string',
        'company_description' => 'nullable|string',
        'website' => 'nullable|url|max:255',
        'phone' => 'nullable|string|max:20',

        'company_logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'jobs_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // --- BƯỚC 2: LẤY EMPLOYER ID ---
    $employerId = Auth::guard('employer')->id();

    // --- BƯỚC 3: XỬ LÝ UPLOAD FILE ---
    $logoPathForDB = null;
    $imagePathForDB = null;

    // Ảnh công việc
    if ($request->hasFile('jobs_images')) {
        $imagePathForDB = $request->file('jobs_images')->store('jobs', 'public');  
        // => jobs/ten_file.jpg
    }

    // Logo công ty
    if ($request->hasFile('company_logo_url')) {
        $logoPathForDB = $request->file('company_logo_url')->store('logos', 'public');
        // => logos/ten_file.png
    }

    // --- BƯỚC 4: TẠO JOB ---
    $job = Job::create([
        'employer_id' => $employerId,

        'title' => $request->title,
        'category' => $request->category,
        'location' => $request->location,
        'level' => $request->level,
        'remote_type' => $request->remote_type,
        'description' => $request->description,

        'salary' => $request->salary,
        'experience' => $request->experience,
        'degree' => $request->degree,
        'gender' => $request->gender,
        'age' => $request->age,
        'required_skills' => $request->required_skills,

        'company_name' => $request->company_name,
        'company_description' => $request->company_description,
        'website' => $request->website,
        'phone' => $request->phone,
        'email' => $request->email,

        'remote' => $request->boolean('remote'),
        'is_featured' => false,
        'posted_at' => now(),
        'status' => 'pending',

        'jobs_images' => $imagePathForDB,        // LƯU DẠNG: jobs/xxx.png
        'company_logo_url' => $logoPathForDB,    // LƯU DẠNG: logos/xxx.png
    ]);

    return redirect()
        ->route('employer.myJobs')
        ->with('success', 'Tin tuyển dụng đã được gửi đi và đang chờ duyệt!');
}

}