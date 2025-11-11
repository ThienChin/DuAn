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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'level' => 'required',
            'remote_type' => 'required',
            'salary' => 'required|numeric',
            'description' => 'required',
        ]);

        Job::create($validated + [
            'company_name' => $request->company_name,
            'is_featured' => $request->boolean('is_featured'),
            'posted_at' => now(),
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'category' => $request->category,
            'status' => 'pending', // ✅ CHỜ DUYỆT
        ]);

        return redirect()
            ->route('Employer.create')
            ->with('success', 'Tin đã gửi và đang chờ admin duyệt!');
    }

}
