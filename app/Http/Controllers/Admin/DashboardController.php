<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\User;
use App\Models\Employer;
use App\Models\Category;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // Lấy số ngày từ request, chỉ chấp nhận 7 hoặc 30, mặc định là 7
        $days = in_array($request->input('days'), [7, 30]) ? $request->input('days') : 7;
        
        // Tính toán ngày bắt đầu dựa trên số ngày được chọn
        $startDate = Carbon::now()->subDays($days);
        
        $totalActiveJobs = Job::where('status', 'approved')->count();
        $totalApplications = JobApplication::where('created_at', '>=', $startDate)->count();
        
        // Tính Tỷ lệ chuyển đổi (CTR) - Tổng ứng dụng / Tổng tin đang hoạt động
        $ctr = ($totalActiveJobs > 0) ? round(($totalApplications / $totalActiveJobs) * 100, 2) : 0;

        $stats = [
            // KPIs 
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'active_jobs' => $totalActiveJobs,
            'total_applications' => $totalApplications, 
            'new_candidates' => User::count(), 
            'new_employers' => Employer::count(), 
            'total_users' => User::count() + Employer::count(),
            'ctr' => $ctr, // KPI MỚI: Tỷ lệ chuyển đổi
        ];
        
        // === Dữ liệu cho Biểu đồ Tăng trưởng (Line Chart) ===
        
        $dates = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        
        $dailyApplications = JobApplication::select(
            DB::raw('DATE(created_at) as day'), 
            DB::raw('count(*) as count')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();
        
        $dailyUsers = User::select(
            DB::raw('DATE(created_at) as day'), 
            DB::raw('count(*) as count')
        )
        ->where('created_at', '>=', $startDate)
        ->groupBy('day')
        ->pluck('count', 'day')
        ->toArray();
        
        $lineChartData = [
            'labels' => array_map(fn($d) => Carbon::parse($d)->format('d/m'), $dates), 
            'applications' => [],
            'users' => [],
        ];
        
        foreach ($dates as $date) {
            $lineChartData['applications'][] = $dailyApplications[$date] ?? 0;
            $lineChartData['users'][] = $dailyUsers[$date] ?? 0;
        }


        // === Dữ liệu cho Biểu đồ Ngành Nghề (Pie Chart - Top 5) ===
        // 1. Thống kê số lượng Job theo từng category_id
        $jobCounts = Job::select('category_id', DB::raw('count(*) as data'))
            ->whereNotNull('category_id') // Chỉ đếm những Jobs có ngành nghề được chỉ định
            ->groupBy('category_id')
            ->orderByDesc('data')
            ->get();

        // 2. Tải thông tin chi tiết của các Category (lấy tên ngành nghề)
        // Lấy tất cả category_id đã thống kê
        $categoryIds = $jobCounts->pluck('category_id');

        // Tải thông tin Category (chỉ cần 'id' và 'value' (tên ngành nghề))
        $categories = Category::whereIn('id', $categoryIds)
            ->pluck('value', 'id'); // Tạo collection dạng [id => value]

        // 3. Chuẩn bị dữ liệu cho Pie Chart
        $pieChartData = $jobCounts->map(function ($item) use ($categories) {
            // Tìm tên (value) của Category dựa trên category_id
            $label = $categories->get($item->category_id, 'Không xác định');
            
            return [
                'label' => $label,
                'data' => (int) $item->data, // Ép kiểu về integer
            ];
        })->toArray(); // Chuyển về array để sử dụng trong View (nếu cần)

        // === Dữ liệu MỚI cho Biểu đồ Top Địa điểm (Bar Chart) ===
        // Lưu ý: Cần join Job với bảng location_items (Giả định bảng này là 'categories' với type='location')
        $topLocationData = DB::table('jobs')
                            ->join('categories as locations', 'jobs.location_id', '=', 'locations.id')
                            ->select('locations.value as label', DB::raw('count(jobs.id) as data'))
                            ->where('jobs.status', 'approved')
                            ->groupBy('locations.value')
                            ->orderByDesc('data')
                            ->limit(5)
                            ->get()
                            ->toArray();


        // Dữ liệu Hành động Gần đây
        $recentPendingJobs = Job::where('status', 'pending')
                                ->with('locationItem') 
                                ->orderBy('posted_at', 'desc')
                                ->take(5)
                                ->get();
                                
        $recentCandidates = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentEmployers = Employer::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPendingJobs', 'recentCandidates', 'recentEmployers', 'lineChartData', 'pieChartData', 'topLocationData'));
    }
}