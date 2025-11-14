<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\User;
use App\Models\Employer;
use App\Models\JobApplication;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $lastWeek = Carbon::now()->subDays(7);
        
        $stats = [
            // KPIs
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'active_jobs' => Job::where('status', 'approved')->count(),
            'total_applications' => JobApplication::where('created_at', '>=', $lastWeek)->count(),
            'new_candidates' => User::where('created_at', '>=', $lastWeek)->count(),
            'new_employers' => Employer::where('created_at', '>=', $lastWeek)->count(),
            'total_users' => User::count() + Employer::count(), // Tổng cả hai loại user
        ];
        
        // Dữ liệu Hành động Gần đây
        $recentPendingJobs = Job::where('status', 'pending')
                                ->with('locationItem') // Cần tải Location Category
                                ->orderBy('posted_at', 'desc')
                                ->take(5)
                                ->get();
                                
        $recentCandidates = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentEmployers = Employer::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPendingJobs', 'recentCandidates', 'recentEmployers'));
    }
}
