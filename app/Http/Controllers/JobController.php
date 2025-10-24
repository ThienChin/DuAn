<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Hiển thị danh sách công việc với tìm kiếm và phân trang
    public function index(Request $request)
    {
        $query = Job::query();

        // Xử lý sắp xếp
        $sort = $request->input('sort');
        if ($sort === 'latest') {
            $query->latest();
        } elseif ($sort === 'highest_salary') {
            $query->orderBy('salary', 'desc');
        }

        // Xử lý tìm kiếm
        if ($request->filled('job-title')) {
            $query->where('title', 'like', '%' . $request->input('job-title') . '%');
        }
        if ($request->filled('job-location')) {
            $query->where('location', 'like', '%' . $request->input('job-location') . '%');
        }
        if ($request->filled('job-salary')) {
            $salaryRanges = [
                '1' => [3000000, 8000000],  // 3-8 triệu VND
                '2' => [10000000, 45000000], // 10-45 triệu VND
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

    // Hiển thị form tạo công việc mới
    public function create()
    {
        if (!Auth::check() || (!Auth::user()->hasRole('employer') && !Auth::user()->hasRole('admin'))) {
            abort(403, 'Bạn không có quyền tạo công việc.');
        }
        return view('jobs.create');
    }

    // Lưu công việc mới vào database
    public function store(Request $request)
    {
        if (!Auth::check() || (!Auth::user()->hasRole('employer') && !Auth::user()->hasRole('admin'))) {
            abort(403, 'Bạn không có quyền tạo công việc.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|in:Internship,Junior,Senior',
            'remote_type' => 'required|in:Full Time,Contract,Part Time',
            'salary' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'posted_at' => 'nullable|date',
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'remote' => 'nullable|boolean',
        ]);

        Job::create([
            'title' => $request->title,
            'location' => $request->location,
            'level' => $request->level,
            'remote_type' => $request->remote_type,
            'salary' => $request->salary,
            'category' => $request->category,
            'description' => $request->description,
            'is_featured' => $request->is_featured,
            'posted_at' => $request->posted_at,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'website' => $request->website,
            'phone' => $request->phone,
            'email' => $request->email,
            'remote' => $request->remote,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Công việc đã được tạo thành công!');
    }

    // Hiển thị chi tiết công việc
    public function show(Job $job)
    {
        return view('jobs.detail', compact('job'));
    }

    // Hiển thị form chỉnh sửa công việc
    public function edit(Job $job)
    {
        if (!Auth::check() || ($job->company_name !== Auth::user()->name && !Auth::user()->hasRole('admin'))) {
            abort(403, 'Bạn không có quyền chỉnh sửa công việc này.');
        }
        return view('jobs.edit', compact('job'));
    }

    // Cập nhật công việc
    public function update(Request $request, Job $job)
    {
        if (!Auth::check() || ($job->company_name !== Auth::user()->name && !Auth::user()->hasRole('admin'))) {
            abort(403, 'Bạn không có quyền chỉnh sửa công việc này.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required|in:Internship,Junior,Senior',
            'remote_type' => 'required|in:Full Time,Contract,Part Time',
            'salary' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'is_featured' => 'nullable|boolean',
            'posted_at' => 'nullable|date',
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'remote' => 'nullable|boolean',
        ]);

        $job->update([
            'title' => $request->title,
            'location' => $request->location,
            'level' => $request->level,
            'remote_type' => $request->remote_type,
            'salary' => $request->salary,
            'category' => $request->category,
            'description' => $request->description,
            'is_featured' => $request->is_featured,
            'posted_at' => $request->posted_at,
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'website' => $request->website,
            'phone' => $request->phone,
            'email' => $request->email,
            'remote' => $request->remote,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Công việc đã được cập nhật!');
    }

    // Xóa công việc
    public function destroy(Job $job)
    {
        if (!Auth::check() || ($job->company_name !== Auth::user()->name && !Auth::user()->hasRole('admin'))) {
            abort(403, 'Bạn không có quyền xóa công việc này.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Công việc đã được xóa!');
    }
}