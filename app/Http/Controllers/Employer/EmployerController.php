<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

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
        $jobs = Job::where('employer_id', auth('employer')->id())->latest()->get();

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
            'employer_id' => auth('employer')->id(),
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
    public function showApplication()
    {
        // Kiểm tra xem Employer đã đăng nhập chưa
        if (!auth('employer')->check()) {
            return redirect()->route('employer.login');
        }

        $employerId = auth('employer')->id();

        // 1. Lấy TẤT CẢ Job mà Employer này đã đăng
        // Eager load các đơn ứng tuyển (applications) và thông tin ứng viên (user)
        $jobs = Job::with(['applications' => function ($query) {
            // Đảm bảo JobApplication model có mối quan hệ 'user' (BelongsTo User::class)
            $query->with('user'); 
        }])
        ->where('employer_id', $employerId)
        ->latest()
        ->get();

        // 2. Làm phẳng danh sách JobApplication thành một mảng duy nhất để dễ truyền sang View
        $applications = $jobs->pluck('applications')->flatten();

        // 3. Trả về View để hiển thị danh sách
        return view('Employer.history', compact('applications'));
    }

    // =================================================================
    // ✅ CHỨC NĂNG: XEM/DOWNLOAD CV
    // =================================================================
    public function viewCv(JobApplication $application)
    {
        // 1. Lấy ID Employer đang đăng nhập
        $employerId = auth('employer')->id();
        
        // 2. Tải mối quan hệ Job để kiểm tra quyền
        $application->load('job');

        // **QUAN TRỌNG:** Kiểm tra xem JobApplication này có thuộc về Job của Employer này không
        if ($application->job->employer_id !== $employerId) {
            // ✅ SỬ DỤNG VIEW VCV KHI KHÔNG CÓ QUYỀN
            return view('Employer.viewCV')
                ->with('error', 'Bạn không có quyền truy cập hồ sơ này.');
        }

        $cvPath = $application->cv;

        // 3. Kiểm tra và trả về file
        if (Storage::disk('public')->exists($cvPath)) {
            // Download file (Nếu thành công, sẽ KHÔNG load View)
            return Storage::disk('public')->download($cvPath, 'CV_' . $application->name . '_' . time() . '.pdf');
        }

        // ✅ SỬ DỤNG VIEW VCV KHI LỖI FILE
        return view('Employer.viewCV')
            ->with('error', 'File CV không tồn tại hoặc đã bị xóa.');
    }
    public function saveCandidate(Request $request, \App\Models\User $user) 
{
    if (!auth('employer')->check()) {
        return redirect()->route('employer.login');
    }

    $employer = auth('employer')->user();
    
    // 1. Kiểm tra xem ứng viên đã được lưu chưa
    if ($employer->savedCandidates()->where('user_id', $user->id)->exists()) {
        // Nếu đã lưu, xóa khỏi danh sách (Toggle function)
        $employer->savedCandidates()->detach($user->id);
        $message = 'Đã hủy lưu hồ sơ ứng viên ' . $user->name . '.';
    } else {
        // Nếu chưa lưu, thêm vào danh sách
        // Giả định cột khóa ngoại trong bảng trung gian là user_id
        $employer->savedCandidates()->attach($user->id);
        $message = 'Đã lưu hồ sơ ứng viên ' . $user->name . ' thành công!';
    }

    // Chuyển hướng về trang trước đó (danh sách ứng tuyển)
    return back()->with('success', $message);
}
}