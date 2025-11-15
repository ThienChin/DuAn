<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication; // <<< Import Model Ứng tuyển
use App\Models\Resume;         // <<< Import Model Resume
use App\Models\Upload;
use App\Models\Employer; // Giả định Model Nhà tuyển dụng
use App\Models\User;     // Giả định Model Ứng viên
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    /**
     * Hiển thị danh sách Nhà Tuyển Dụng (Employers).
     */
    public function employersIndex(Request $request)
    {
        // Giả định Employer Model có cột 'is_banned' để quản lý khóa tài khoản
        $employers = Employer::latest()
                            ->paginate(15);

        return view('admin.users.employers_list', compact('employers'));
    }

    public function employerShow(Employer $employer)
    {
        // 1. Tính toán các chỉ số thống kê
        $totalJobs = $employer->jobs()->count();
        // Tin đang hoạt động (Đã duyệt)
        $activeJobs = $employer->jobs()->where('status', 'approved')->count(); 
        // Tin chờ duyệt
        $pendingJobs = $employer->jobs()->where('status', 'pending')->count();
        // Tin đã bị từ chối
        $rejectedJobs = $employer->jobs()->where('status', 'rejected')->count();

        // 2. Trả về view và truyền các biến thống kê
        return view('admin.users.employer_detail', compact('employer', 'totalJobs', 'activeJobs', 'pendingJobs', 'rejectedJobs'));
    }

    /**
     * Hiển thị danh sách Ứng Viên (Candidates).
     */
    public function candidatesIndex(Request $request)
    {
        // Giả định User Model có cột 'is_banned'
        $candidates = User::latest()
                          ->paginate(15);

        return view('admin.users.candidates_list', compact('candidates'));
    }

    public function candidateShow(User $user)
    {
        // 1. Lấy dữ liệu thống kê
        $totalApplications = JobApplication::where('user_id', $user->id)->count();
        $totalUploads = Upload::where('user_id', $user->id)->count();

        // 2. LẤY LẦN HOẠT ĐỘNG CUỐI (SỬA ĐỔI ĐỂ DÙNG last_login_at)
        $lastLogin = $user->last_login_at;
        
        $lastActivity = $lastLogin 
            ? Carbon::parse($lastLogin)->diffForHumans() 
            : 'Chưa từng đăng nhập'; // Đổi từ 'Mới đăng ký' thành 'Chưa từng đăng nhập'
            
        // 3. Lấy lịch sử ứng tuyển
        $applications = JobApplication::with('job')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // 4. Chuẩn bị mảng thống kê để truyền qua view
        $stats = [
            'total_applications' => $totalApplications,
            // Giả định 'total_created_cvs' bị mất, có thể thay bằng $user->resumes()->count() nếu có Resume Model
            'total_files_uploaded' => $totalUploads,
            'last_activity' => $lastActivity, // Dùng giá trị đã được tính toán
        ];
        
        // 5. Trả về view với dữ liệu User và Thống kê
        return view('admin.users.candidate_detail', [
            'user' => $user,
            'stats' => $stats, 
            'applications' => $applications,
        ]);
    }

    /**
     * Hiển thị chi tiết đơn ứng tuyển (JobApplication)
     */
    public function applicationShow(JobApplication $application)
    {
        // Eager load:
        // 1. user: Thông tin ứng viên
        // 2. job: Thông tin công việc
        // 3. job.locationItem: Load mối quan hệ Category con cho Location của Job
        $application->load([
            'user', 
            'job' => function ($query) {
                $query->with(['locationItem']); // Tải cụ thể locationItem cho Job
            }
        ]); 

        return view('admin.users.application_detail', compact('application'));
    }

    public function edit(User $user)
    {   
        // Nếu dùng view riêng (chuyển trang):
        return view('admin.users.edit_candidates', compact('user'));
    }


    /**
     * [PUT/PATCH] Xử lý việc cập nhật thông tin sau khi form được gửi.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Đảm bảo email là duy nhất, trừ chính email hiện tại của user này.
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Nếu bạn muốn cho phép Admin thay đổi mật khẩu (cần thêm trường 'password' trong form):
        /*
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        */

        $user->save();

        // Chuyển hướng về trang chi tiết ứng viên sau khi cập nhật thành công
        return redirect()->route('admin.users.candidate_show', $user->id)
                         ->with('editUserId', $user->id)
                         ->with('success', 'Thông tin ứng viên đã được cập nhật thành công.');
    }

    public function deleteCv(User $user)
    {
        // 1. Xóa file khỏi storage
        if ($user->cv_path && Storage::disk('public')->exists($user->cv_path)) {
            Storage::disk('public')->delete($user->cv_path);
        }
        
        // 2. Xóa đường dẫn trong database
        $user->cv_path = null;
        $user->save();

        return redirect()->back()->with('success', 'CV đã được xóa khỏi hồ sơ ứng viên.');
    }

}