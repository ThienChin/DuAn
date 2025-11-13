<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer; // Giả định Model Nhà tuyển dụng
use App\Models\User;     // Giả định Model Ứng viên

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
        // Trả về view chi tiết Candidate
        return view('admin.users.candidate_detail', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Thêm validation cho các trường khác nếu có
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Lưu ý: Nếu bạn muốn cho phép Admin thay đổi mật khẩu, cần thêm logic hash:
        /*
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        */

        $user->save();

        return redirect()->back()->with('success', 'Thông tin ứng viên đã được cập nhật thành công.');
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