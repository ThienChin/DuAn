<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    /**
     * Hiển thị danh sách tin tuyển dụng dựa trên status (pending, approved, rejected, all).
     */
    public function index(Request $request) 
    {
        // Lấy status từ query string, mặc định là 'pending'
        $status = $request->get('status', 'pending');
        
        $query = Job::query();

        // Áp dụng bộ lọc trạng thái
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        
        // Thêm điều kiện sắp xếp và phân trang
        $jobs = $query->latest('posted_at')->paginate(20)->withQueryString();

        // Trả về view quản lý chung (Giả định vẫn dùng tên view pending.blade.php)
        return view('admin.jobs.pending', compact('jobs')); 
    }

    public function employerJobsIndex($employerId) 
    {
        $employer = Employer::findOrFail($employerId);

        // Lọc Jobs theo email của Employer (vì Job model không có employer_id)
        $jobs = Job::where('email', $employer->email)
                ->latest()
                ->paginate(20);

        // Giả định bạn dùng lại view quản lý jobs chung (ví dụ: admin.pending)
        return view('admin.jobs.pending', [
            'jobs' => $jobs,
            'title' => 'Danh sách tin tuyển dụng của công ty: ' . $employer->company_name,
            // Có thể truyền thêm biến khác nếu cần
        ]); 
    }

    /**
     * Hiển thị chi tiết bài đăng
     */
    public function show(Job $job)
    {
        return view('admin.jobs.job_detail', compact('job'));
    }

    /**
     * Duyệt bài đăng (Chuyển status sang 'approved').
     */
    public function approve(Job $job)
    {
        $job->update([
            'status' => 'approved',
            'posted_at' => now(), // Cập nhật thời gian đăng chính thức
        ]);
        
        // Chuyển hướng về trạng thái hiện tại (hoặc về pending nếu không có)
        $redirectToStatus = request('status', 'pending');
        
        return redirect()->route('admin.jobs.index', ['status' => $redirectToStatus])
                         ->with('success', "Đã duyệt tin tuyển dụng '{$job->title}' thành công.");
    }

    /**
     * Từ chối bài đăng (Chuyển status sang 'rejected').
     */
    public function reject(Job $job)
    {
        $job->update(['status' => 'rejected']);
        
        // Chuyển hướng về trạng thái hiện tại
        $redirectToStatus = request('status', 'pending');

        return redirect()->route('admin.jobs.index', ['status' => $redirectToStatus])
                         ->with('success', "Đã từ chối tin tuyển dụng '{$job->title}'.");
    }

    public function edit(Job $job)
    {
        // Trả về view chỉnh sửa. Bạn cần tạo file 'admin.job_edit'.
        return view('admin.jobs.job_edit', compact('job'));
    }

    /**
     * Xử lý cập nhật thông tin bài đăng.
     */
    public function update(Request $request, Job $job)
    {
        // Cần phải có tất cả các trường bạn muốn lưu trong validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'remote_type' => 'required|string|max:50',
            'salary' => 'nullable|numeric|min:0', // Đã là numeric, OK
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'company_name' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected', 
            
            // Cần thêm tất cả các trường khác có trong Model Job của bạn
            'experience' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'age' => 'nullable|string|max:50',
            'required_skills' => 'nullable|string',
            'company_description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'company_logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File ảnh, tối đa 2MB
            'jobs_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File ảnh, tối đa 2MB
        ]);
        
        // Xử lý các trường Boolean/Checkbox cần thiết (is_featured và remote)
        // Nếu checkbox KHÔNG được gửi lên, nó sẽ là false (0)
        $validated['is_featured'] = $request->has('is_featured'); 
        $validated['remote'] = $request->has('remote');
        
        // Cập nhật Job
        // Lỗi có thể do bạn chưa khai báo đủ trường trong $fillable của Model Job
        $job->update($validated);

        return redirect()->route('admin.jobs.show', $job->id)
                        ->with('success', "Cập nhật tin tuyển dụng '{$job->title}' thành công!");
    }

    public function destroy(Job $job)
    {
        $jobTitle = $job->title;
        
        // Thực hiện xóa vĩnh viễn
        $job->delete();

        // Chuyển hướng về trang quản lý chung
        return redirect()->route('admin.jobs.index')
                        ->with('success', "Đã xóa vĩnh viễn tin tuyển dụng '{$jobTitle}' thành công.");
    }
}