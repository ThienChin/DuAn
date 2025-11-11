<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class AdminJobController extends Controller
{
    // Liste các job pending
    public function pending()
    {
        $jobs = Job::where('status', 'pending')->get();
        return view('admin.jobs.pending', compact('jobs'));
    }

    // Duyệt job
    public function approve($id)
    {
        Job::where('id', $id)->update(['status' => 'approved']);
        return back()->with('success', 'Duyệt tin thành công!');
    }

    // Từ chối job
    public function reject($id)
    {
        Job::where('id', $id)->update(['status' => 'rejected']);
        return back()->with('success', 'Đã từ chối tin tuyển dụng.');
    }
}
