<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function show(Job $job)
    {
        // SỬA: Thêm remoteTypeItem vào eager loading
        $job->load([
            'locationItem',
            'levelItem',
            'categoryItem',
            'experienceItem',
            'genderItem',
            'degreeItem',
            'remoteTypeItem' // <-- ĐÃ THÊM
        ]);

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
        // Lấy dữ liệu danh mục dựa trên trường 'key'
        $categories = Category::where('key', 'category')->get();
        $locations = Category::where('key', 'location')->get();
        $levels = Category::where('key', 'level')->get();
        
        // Thêm 3 danh mục mới
        $experiences = Category::where('key', 'experience')->get();
        $genders = Category::where('key', 'gender')->get();
        $degrees = Category::where('key', 'degree')->get();

        // THÊM: Lấy danh mục Remote Type
        $remoteTypes = Category::where('key', 'remote_type')->get();

        // Truyền tất cả các biến cần thiết sang view
        return view('admin.jobs.job_edit', compact(
            'job', 
            'categories', 
            'locations', 
            'levels',
            // Các biến mới
            'experiences',
            'genders',
            'degrees',
            'remoteTypes' // <-- ĐÃ THÊM
        ));
    }

    /**
     * Cập nhật tin tuyển dụng - Chỉ cập nhật những trường được gửi
     */
    public function update(Request $request, Job $job)
    {
        // 1. Danh sách các trường có thể cập nhật
        $fillableFields = [
            'title', 'company_name', 'location_id', 'level_id', 'category_id',
            'experience_id', 'gender_id', 'degree_id', 'remote_type_id', 'salary', // SỬA: 'remote_type' -> 'remote_type_id'
            'description', 'status', 'is_featured', 'remote', 'age',
            // Thêm các trường khác để validation có thể chạy
            'company_logo_url', 'jobs_images',
        ];

        // 2. VALIDATION: Chỉ validate những field có trong request VÀ có trong $fillableFields
        $rules = [
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location_id' => 'nullable|integer|exists:categories,id',
            'level_id' => 'nullable|integer|exists:categories,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'experience_id' => 'nullable|integer|exists:categories,id',
            'gender_id' => 'nullable|integer|exists:categories,id',
            'degree_id' => 'nullable|integer|exists:categories,id',
            
            // SỬA: Validation cho ID
            'remote_type_id' => 'nullable|integer|exists:categories,id', 
            
            'salary' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            // Checkbox/Boolean
            'is_featured' => 'boolean', 
            'remote' => 'boolean', 
            'age' => 'nullable|string|max:50',

            // File
            'company_logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jobs_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Chỉ validate những field được gửi trong request và có trong rules
        $validated = $request->validate(array_intersect_key($rules, $request->all()));

        // 3. XỬ LÝ CÁC TRƯỜNG ĐẶC BIỆT/THIẾU
        
        // --- Checkbox (is_featured, remote): Nếu không có trong request, set 0
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['remote'] = $request->has('remote') ? 1 : 0;
        
        // --- Các trường ID (bao gồm remote_type_id): nếu gửi rỗng (empty string) → set NULL
        $nullableIdFields = ['location_id', 'level_id', 'category_id', 'experience_id', 'gender_id', 'degree_id', 'remote_type_id']; // <-- ĐÃ THÊM 'remote_type_id'
        foreach ($nullableIdFields as $field) {
            if (isset($validated[$field]) && ($validated[$field] === '' || $validated[$field] === null)) {
                $validated[$field] = null;
            }
        }

        // --- salary: nếu rỗng → null
        if (isset($validated['salary']) && $validated['salary'] === '') {
            $validated['salary'] = null;
        }

        // 4. XỬ LÝ UPLOAD FILE (Giữ nguyên logic file)
        $storagePath = 'public/jobs/uploads';
        
        // Xử lý logo
        if ($request->hasFile('company_logo_url')) {
            if ($job->company_logo_url && Storage::exists($job->company_logo_url)) {
                Storage::delete($job->company_logo_url);
            }
            $validated['company_logo_url'] = $request->file('company_logo_url')->store($storagePath);
        } elseif ($request->has('company_logo_url') && $request->input('company_logo_url') === 'null') {
            if ($job->company_logo_url && Storage::exists($job->company_logo_url)) {
                Storage::delete($job->company_logo_url);
            }
            $validated['company_logo_url'] = null;
        } else {
            unset($validated['company_logo_url']);
        }

        // Xử lý jobs_images
        if ($request->hasFile('jobs_images')) {
            if ($job->jobs_images && Storage::exists($job->jobs_images)) {
                Storage::delete($job->jobs_images);
            }
            $validated['jobs_images'] = $request->file('jobs_images')->store($storagePath);
        } elseif ($request->has('jobs_images') && $request->input('jobs_images') === 'null') {
            if ($job->jobs_images && Storage::exists($job->jobs_images)) {
                Storage::delete($job->jobs_images);
            }
            $validated['jobs_images'] = null;
        } else {
            unset($validated['jobs_images']);
        }

        // 5. CẬP NHẬT posted_at nếu chuyển sang approved
        if ($job->status !== 'approved' && ($validated['status'] ?? $job->status) === 'approved') {
            $validated['posted_at'] = now();
        }

        // 6. CẬP NHẬT JOB
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

    public function updateStatus(Request $request, Job $job)
    {
        $newStatus = $request->input('action');
        
        if (!in_array($newStatus, ['approved', 'rejected', 'pending'])) {
            return redirect()->back()->with('error', 'Trạng thái cập nhật không hợp lệ.');
        }

        try {
            $job->status = $newStatus;
            
            if ($newStatus === 'approved') {
                if (!$job->posted_at) {
                    $job->posted_at = now();
                }
            }

            $job->save();

            return redirect()->route('admin.jobs.show', $job->id)->with('success', 'Tin tuyển dụng "' . $job->title . '" đã được cập nhật thành công.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật trạng thái tin tuyển dụng: ' . $e->getMessage());
        }
    }
}