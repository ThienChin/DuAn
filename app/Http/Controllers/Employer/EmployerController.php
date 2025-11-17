<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // ✨ ĐÃ THÊM: Sử dụng Facade Storage
use App\Models\JobApplication;
use Illuminate\Support\Facades\Mail; // Để gửi mail
use App\Mail\ApplicationAcceptedMail; 
use App\Mail\ApplicationRejectedMail;
use Carbon\Carbon;

class EmployerController extends Controller
{
    public function intro()
    {
        return view('Employer.intro');
    }

    public function dashboard()
    {
        // Lấy ID của nhà tuyển dụng hiện tại
        $employerId = Auth::guard('employer')->id(); 

        // 1. Đếm số Việc làm đã đăng
        $postedJobsCount = Job::where('employer_id', $employerId)->count(); 

        // 2. Đếm số Hồ sơ ứng tuyển (cho TẤT CẢ công việc của nhà tuyển dụng này)
        // Chúng ta cần lấy ID của tất cả các Job của Employer này trước
        $jobIds = Job::where('employer_id', $employerId)->pluck('id');

        // Sau đó đếm số lượng hồ sơ ứng tuyển liên quan đến các Job ID đó
        $applicationsCount = JobApplication::whereIn('job_id', $jobIds)->count();

        $viewedApplicationsCount = JobApplication::whereIn('job_id', $jobIds)
                                            ->where('is_viewed_by_employer', true)
                                            ->count();
        
        // Hoặc nếu bạn muốn đếm hồ sơ đã được lưu (saved candidates),
        // bạn cần truy cập qua mối quan hệ của model Employer:
        // $savedCandidatesCount = auth('employer')->user()->savedCandidates()->count();


        return view('Employer.dashboard', [
            'postedJobsCount' => $postedJobsCount,
            'applicationsCount' => $applicationsCount,
            'viewedApplicationsCount'=>$viewedApplicationsCount,
            // Thêm các biến đếm khác nếu cần: 'savedCandidatesCount' => $savedCandidatesCount,
        ]);
    }


    public function myJobs()
    {
        // Sử dụng Auth::guard('employer') để lấy ID của nhà tuyển dụng đã đăng nhập
        $employerId = Auth::guard('employer')->id(); 

        // Tải các Job, đồng thời tải luôn mối quan hệ với Category để tránh N+1 query
        $jobs = Job::where('employer_id', $employerId)
                    ->with(['locationItem', 'levelItem'])
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
        // SỬA: Thay validation chuỗi bằng validation ID khóa ngoại
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            // Validation cho Khóa ngoại (phải là ID và tồn tại trong bảng categories)
            'category_id' => 'required|integer|exists:categories,id',
            'location_id' => 'required|integer|exists:categories,id',
            'level_id' => 'required|integer|exists:categories,id',
            'remote_type_id' => 'required|integer|exists:categories,id',
            
            // Validation cho Khóa ngoại Tùy chọn
            'experience_id' => 'nullable|integer|exists:categories,id',
            'degree_id' => 'nullable|integer|exists:categories,id',
            'gender_id' => 'nullable|integer|exists:categories,id',


            'salary' => 'nullable|numeric|min:0',
            'remote' => 'nullable|boolean',
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
            // LƯU Ý: Đổi 'jobs' thành 'jobs/images' cho rõ ràng hơn nếu cần, nhưng giữ 'jobs' theo code cũ.
            $imagePathForDB = $request->file('jobs_images')->store('jobs', 'public');  
        }
        
        // Logo công ty
        if ($request->hasFile('company_logo_url')) {
            $logoPathForDB = $request->file('company_logo_url')->store('logos', 'public');
        }

        // --- BƯỚC 4: TẠO JOB ---
        // SỬA: Lưu các ID khóa ngoại thay vì giá trị chuỗi
        $job = Job::create([
            'employer_id' => $employerId,

            'title' => $request->title,
            'description' => $request->description,

            // SỬA: LƯU CÁC KHÓA NGOẠI ID
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'level_id' => $request->level_id,
            'remote_type_id' => $request->remote_type_id,

            'salary' => $request->salary,
            
            // SỬA: LƯU CÁC KHÓA NGOẠI ID TÙY CHỌN
            'experience_id' => $request->experience_id,
            'degree_id' => $request->degree_id,
            'gender_id' => $request->gender_id,
            
            // Các trường còn lại giữ nguyên
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

            'jobs_images' => $imagePathForDB,        
            'company_logo_url' => $logoPathForDB,    
        ]);

        return redirect()
            ->route('employer.myJobs')
            ->with('success', 'Tin tuyển dụng đã được gửi đi và đang chờ duyệt!');
    }

    /**
     * [GET] Hiển thị form để chỉnh sửa tin tuyển dụng đã đăng.
     */
    public function edit(\App\Models\Job $job)
    {
        // 1. Kiểm tra quyền sở hữu
        if ($job->employer_id !== Auth::guard('employer')->id()) {
            return redirect()->route('employer.myJobs')->with('error', 'Bạn không có quyền chỉnh sửa tin tuyển dụng này.');
        }

        // 2. Tải lại dữ liệu danh mục (giống như hàm create)
        $categoriesData = Category::all()->groupBy('key');
        
        $data = [
            'job' => $job, // Tin tuyển dụng hiện tại
            'locations' => $categoriesData->get('location', collect())->sortBy('order'),
            'levels' => $categoriesData->get('level', collect())->sortBy('order'),
            'categories' => $categoriesData->get('category', collect())->sortBy('order'),
            'remote_types' => $categoriesData->get('remote_type', collect())->sortBy('order'),
            'experiences' => $categoriesData->get('experience', collect())->sortBy('order'),
            'degrees' => $categoriesData->get('degree', collect())->sortBy('order'),
            'genders' => $categoriesData->get('gender', collect())->sortBy('order'),
        ];

        return view('Employer.edit', $data);
    }


    /**
     * [PUT] Xử lý cập nhật tin tuyển dụng.
     */
    public function update(Request $request, \App\Models\Job $job)
    {
        // 1. Kiểm tra quyền sở hữu
        if ($job->employer_id !== Auth::guard('employer')->id()) {
            return redirect()->route('employer.myJobs')->with('error', 'Bạn không có quyền cập nhật tin tuyển dụng này.');
        }

        // 2. Validation (Sử dụng lại rules từ hàm store)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'category_id' => 'required|integer|exists:categories,id',
            'location_id' => 'required|integer|exists:categories,id',
            'level_id' => 'required|integer|exists:categories,id',
            'remote_type_id' => 'required|integer|exists:categories,id',
            
            'experience_id' => 'nullable|integer|exists:categories,id',
            'degree_id' => 'nullable|integer|exists:categories,id',
            'gender_id' => 'nullable|integer|exists:categories,id',

            'salary' => 'nullable|numeric|min:0',
            'remote' => 'nullable|boolean',
            'age' => 'nullable|string|max:50',
            'required_skills' => 'nullable|string',
            'company_description' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',

            // Cho phép upload file mới (hoặc để trống)
            'company_logo_url_new' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jobs_images_new' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // 3. Xử lý Upload File MỚI
        $data = $request->except(['_token', '_method', 'company_logo_url_new', 'jobs_images_new']);
        
        if ($request->hasFile('jobs_images_new')) {
            // Xóa file cũ nếu tồn tại
            if ($job->jobs_images) {
                Storage::disk('public')->delete($job->jobs_images);
            }
            $data['jobs_images'] = $request->file('jobs_images_new')->store('jobs', 'public');
        }
        
        if ($request->hasFile('company_logo_url_new')) {
             // Xóa file cũ nếu tồn tại
            if ($job->company_logo_url) {
                Storage::disk('public')->delete($job->company_logo_url);
            }
            $data['company_logo_url'] = $request->file('company_logo_url_new')->store('logos', 'public');
        }

        // 4. Cập nhật Job
        $job->update($data);

        return redirect()
            ->route('employer.myJobs')
            ->with('success', 'Tin tuyển dụng đã được cập nhật thành công!');
    }

    /**
     * [DELETE] Xử lý xóa tin tuyển dụng.
     */
    public function destroy(\App\Models\Job $job)
    {
        // 1. Kiểm tra quyền sở hữu
        if ($job->employer_id !== Auth::guard('employer')->id()) {
            return redirect()->route('employer.myJobs')->with('error', 'Bạn không có quyền xóa tin tuyển dụng này.');
        }

        try {
            // Xóa các file liên quan trước (logo, jobs_images)
            if ($job->jobs_images) {
                Storage::disk('public')->delete($job->jobs_images);
            }
            if ($job->company_logo_url) {
                Storage::disk('public')->delete($job->company_logo_url);
            }
            
            // Xóa bản ghi
            $job->delete();

            return redirect()->route('employer.myJobs')->with('success', 'Tin tuyển dụng đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thể xóa tin tuyển dụng: ' . $e->getMessage());
        }
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

    public function showApplicationForm(JobApplication $application, $action)
    {

        $application->load(['job.locationItem']); 

        $currentStatus = strtolower(trim($application->status ?? 'pending'));

        $employerId = Auth::guard('employer')->id();

        // 0. Kiểm tra quyền và trạng thái JobApplication
        // Nếu trạng thái đã được xử lý (KHÁC 'pending') HOẶC Employer không có quyền, thì chặn.
        if ($currentStatus !== 'pending' || $application->job->employer_id !== $employerId) {
            return redirect()->route('employer.history')->with('error', 'Đơn ứng tuyển này đã được xử lý hoặc bạn không có quyền.');
        }

        if (!in_array($action, ['accepted', 'rejected'])) {
            return redirect()->route('employer.history')->with('error', 'Hành động không hợp lệ.');
        }
        
        // 1. Trả về view form chuyên dụng
        return view('Employer.application_form', compact('application', 'action'));
    }

    /**
     * [PUT] Xử lý form gửi quyết định và Email (Hẹn giờ/Từ chối)
     */
// FILE: EmployerController.php (trong hàm public function sendDecision)

// FILE: EmployerController.php (Trong hàm sendDecision)

public function sendDecision(Request $request, JobApplication $application)
{
    // Load employer kiểm tra quyền
    $application->load(['job.employer']);

    if ($application->job->employer_id !== Auth::guard('employer')->id()) {
        return redirect()->route('employer.history')
            ->with('error', 'Bạn không có quyền xử lý ứng viên này.');
    }

    // Lấy status được gửi từ form: accepted | rejected
    $status = $request->status;

    // ============================
    // 🎯 1. NẾU ACCEPTED
    // ============================
    if ($status === 'accepted') {

        // Validate thông tin phỏng vấn
        $request->validate([
            'interview_date' => 'required|date',
            'interview_time' => 'required',
            'interview_location' => 'required|string',
        ]);

        // Update trạng thái trong DB
        $application->status = 'accepted';
        $application->interview_date = $request->interview_date;
        $application->interview_time = $request->interview_time;
        $application->interview_location = $request->interview_location;
        $application->save();

        // Gửi email ACCEPTED
        Mail::to($application->email)->send(
            new ApplicationAcceptedMail(
                candidateName: $application->name,
                companyName: $application->job->company_name,
                jobTitle: $application->job->title,
                customMessage: $request->message,
                interviewDate: $request->interview_date,
                interviewTime: $request->interview_time,
                interviewLocation: $request->interview_location
            )
        );

        return redirect()->route('employer.history')
            ->with('success', 'Đã chấp nhận và gửi thư mời phỏng vấn.');
    }

    // ============================
    // 🎯 2. NẾU REJECTED
    // ============================
    if ($status === 'rejected') {

        // Không cần validate nhiều
        $application->status = 'rejected';
        $application->save();

        // Gửi email REJECTED
        Mail::to($application->email)->send(
            new ApplicationRejectedMail(
                candidateName: $application->name,
                companyName: $application->job->company_name,
                jobTitle: $application->job->title,
                customMessage: $request->message,
            )
        );

        return redirect()->route('employer.history')
            ->with('success', 'Đã từ chối và gửi email thông báo.');
    }

    // ============================
    // 🎯 Trạng thái không hợp lệ
    // ============================
    return back()->with('error', 'Trạng thái xử lý không hợp lệ.');
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



    public function viewCv(JobApplication $application)
    {
        // 1. Lấy ID Employer đang đăng nhập
        $employerId = auth('employer')->id();
        
        // 2. Tải mối quan hệ Job để kiểm tra quyền
        $application->load('job');

        // **QUAN TRỌNG:** Kiểm tra xem JobApplication này có thuộc về Job của Employer này không
        if ($application->job->employer_id !== $employerId) {
            // ... (Xử lý không có quyền)
            return view('Employer.viewCV')
                ->with('error', 'Bạn không có quyền truy cập hồ sơ này.');
        }

        // ✨✨ ĐOẠN CODE SỬA LỖI: ĐẶT LOGIC CẬP NHẬT LÊN TRÊN CÙNG (SAU KIỂM TRA QUYỀN) ✨✨
        if (!$application->is_viewed_by_employer) {
            $application->update([
                'is_viewed_by_employer' => true,
                'viewed_at' => now(), 
            ]);
        }
        // ---------------------------------------------------------------------------------

        $cvPath = $application->cv;

        // 3. Kiểm tra và trả về file
        if (Storage::disk('public')->exists($cvPath)) {
            // Download file (Lệnh RETURN ở đây sẽ kết thúc hàm, nhưng trạng thái đã được cập nhật)
            return Storage::disk('public')->download($cvPath, 'CV_' . $application->name . '_' . time() . '.pdf');
        }

        // ✅ SỬ DỤNG VIEW VCV KHI LỖI FILE
        return view('Employer.viewCV')
            ->with('error', 'File CV không tồn tại hoặc đã bị xóa.');
    }
    

    /**
     * Cập nhật trạng thái đơn ứng tuyển và gửi Email thông báo cho ứng viên.
     */
    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $newStatus = $request->input('status');
        $customMessage = $request->input('message') ?? ''; 

        // 1. Kiểm tra trạng thái hợp lệ
        if (!in_array($newStatus, ['accepted', 'rejected'])) {
            return redirect()->back()->with('error', 'Trạng thái cập nhật không hợp lệ.');
        }

        try {
            // 2. Cập nhật trạng thái
            $application->status = $newStatus;
            $application->save();

            // 3. Gửi Email thông báo
            $application->load('job'); 
            $jobTitle = $application->job->title ?? 'Vị trí không xác định';
            $candidateEmail = $application->email;

            if ($newStatus === 'accepted') {
                $interviewDetails = $request->only([
                    'interview_date', 
                    'interview_time', 
                    'interview_location', 
                    'message'
                ]);

                // Chuẩn hóa customMessage
                $interviewDetails['customMessage'] = $interviewDetails['message'] ?? '';
                unset($interviewDetails['message']);

                Mail::to($candidateEmail)->send(new ApplicationAcceptedMail($application, $interviewDetails));

                $message = "Đã CHẤP NHẬN hồ sơ của {$application->name} cho vị trí '{$jobTitle}' và gửi Email mời phỏng vấn thành công.";
            } else {
                // Reject: chỉ truyền string
                Mail::to($candidateEmail)->send(new ApplicationRejectedMail($application, $customMessage));

                $message = "Đã TỪ CHỐI hồ sơ của {$application->name} cho vị trí '{$jobTitle}' và gửi Email thông báo thành công.";
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            \Log::error("Lỗi gửi Email hoặc cập nhật trạng thái đơn ứng tuyển: " . $e->getMessage(), ['application_id' => $application->id]);
            return redirect()->back()->with('error', 'Lỗi khi cập nhật trạng thái hoặc gửi Email. Vui lòng kiểm tra lại cấu hình mail và log.');
        }
    }

    // ... (Các methods hiện tại) ...

    /**
     * [GET] Hiển thị form chỉnh sửa thông tin công ty.
     */
    public function showCompanyInfo()
    {
        $employer = Auth::guard('employer')->user();
        return view('Employer.settings.companyInfo', compact('employer'));
    }

    /**
     * [PUT] Xử lý cập nhật thông tin công ty.
     */
    public function updateCompanyInfo(Request $request)
    {
        $employer = Auth::guard('employer')->user();

        // 1. Validation (Sử dụng lại rules từ hàm store/register)
        $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'company_logo_url_new' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Xử lý Upload Logo MỚI
        $logoPathForDB = $employer->company_logo_url;

        if ($request->hasFile('company_logo_url_new')) {
            // Xóa file cũ nếu tồn tại
            if ($employer->company_logo_url) {
                Storage::disk('public')->delete($employer->company_logo_url);
            }
            $logoPathForDB = $request->file('company_logo_url_new')->store('logos', 'public');
        }
        
        // 3. Cập nhật Employer
        $employer->update([
            'company_name' => $request->company_name,
            'website' => $request->website,
            'address' => $request->address,
            'description' => $request->description,
            'company_logo_url' => $logoPathForDB,
        ]);

        return redirect()->route('employer.companyInfo')->with('success', 'Thông tin công ty đã được cập nhật thành công!');
    }


    /**
     * [GET] Hiển thị form chỉnh sửa thông tin tài khoản cá nhân (Recruiter).
     */
    public function showAccountSettings()
    {
        $employer = Auth::guard('employer')->user();
        return view('Employer.settings.accountSettings', compact('employer'));
    }

    /**
     * [PUT] Xử lý cập nhật thông tin tài khoản cá nhân và mật khẩu.
     */
    public function updateAccountSettings(Request $request)
    {
        $employer = Auth::guard('employer')->user();
        
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employers,email,' . $employer->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|in:Nam,Nữ',
            
            // Validation Mật khẩu (nếu người dùng muốn đổi)
            'current_password' => 'nullable|required_with:password_new|current_password:employer', // Check password cũ
            'password_new' => 'nullable|min:6|confirmed', // password_new_confirmation
        ]);

        // 2. Cập nhật thông tin cơ bản
        $employer->name = $request->name;
        $employer->email = $request->email;
        $employer->phone = $request->phone;
        $employer->gender = $request->gender;
        
        // 3. Cập nhật mật khẩu nếu có
        if ($request->filled('password_new')) {
            $employer->password = Hash::make($request->password_new);
        }

        $employer->save();

        // 4. Chuyển hướng
        return redirect()->route('employer.accountSettings')->with('success', 'Cài đặt tài khoản đã được cập nhật thành công!');
    }
}

