<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplyMail;

class JobController extends Controller
{
    // 🧭 Hiển thị danh sách công việc
    public function index(Request $request)
    {
        $query = Job::query();
        // Sắp xếp
        $sort = $request->input('sort');
        if ($sort === 'latest') {
            $query->latest();
        } elseif ($sort === 'highest_salary') {
            $query->orderBy('salary', 'desc');
        }

        // Bộ lọc tìm kiếm
        if ($request->filled('job-title')) {
            $query->where('title', 'like', '%' . $request->input('job-title') . '%');
        }
        if ($request->filled('job-location')) {
            $query->where('location', 'like', '%' . $request->input('job-location') . '%');
        }
        if ($request->filled('job-salary')) {
            $salaryRanges = [
                '1' => [3000000, 8000000],
                '2' => [10000000, 45000000],
            ];
            if (isset($salaryRanges[$request->input('job-salary')])) {
                $query->whereBetween('salary', $salaryRanges[$request->input('job-salary')]);
            }
        }
        if ($request->filled('job-level')) {
            $levels = ['1' => 'Internship', '2' => 'Junior', '3' => 'Senior'];
            if (isset($levels[$request->input('job-level')])) {
                $query->where('level', $levels[$request->input('job-level')]);
            }
        }
        if ($request->filled('job-remote')) {
            $remoteOptions = ['1' => 'Full Time', '2' => 'Contract', '3' => 'Part Time'];
            if (isset($remoteOptions[$request->input('job-remote')])) {
                $query->where('remote_type', $remoteOptions[$request->input('job-remote')]);
            }
        }
        if ($request->filled('job-category')) {
            $query->where('category', 'like', '%' . $request->input('job-category') . '%');
        }

        $jobs = $query->paginate(12);

        return view('page.list', compact('jobs'));
    }

    // 📄 Chi tiết công việc
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.detail', compact('job'));
    }

    // 📝 Form Apply Job
    public function applyForm($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.apply', compact('job'));
    }

    // 🚀 Xử lý Apply Job
    public function apply(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'message' => 'nullable|string',
        ]);

        // Upload CV nếu có
        $cvPath = $request->hasFile('cv')
            ? $request->file('cv')->store('cvs', 'public')
            : null;

        // Lưu vào DB
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cv' => $cvPath,
            'message' => $validated['message'] ?? null,
        ]);

        // Gửi mail cảm ơn
        Mail::to($validated['email'])->send(new ApplyMail($job->title, $validated['name']));

        // sau khi gửi mail và lưu JobApplication
        return redirect()->route('jobs.apply.success')
            ->with([
                'applicant_name' => $validated['name'],
                'job_title' => $job->title,
            ]);

        }

        public function applySuccess()
        {
            // Lấy dữ liệu flash từ redirect->with(...)
            $name = session('applicant_name');
            $title = session('job_title');

            // Nếu không có (người vào trực tiếp), chuyển về index hoặc trang khác
            if (!$name || !$title) {
                return redirect()->route('jobs.index')->with('error', 'Không tìm thấy thông tin ứng tuyển. Vui lòng thực hiện apply trước.');
            }

            // Trả view success (giữ path jobs.success nếu bạn dùng folder jobs)
            return view('jobs.success', [
                'name'  => $name,
                'title' => $title,
            ]);
        }

}
