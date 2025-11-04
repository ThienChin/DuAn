<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Loại bỏ use App\Models\Job; (Tùy chọn)
use App\Models\FeaturedJob; // Chỉ cần Model này
use App\Models\Job; // Chỉ cần Model này

class HomeController extends Controller
{
    public function index()
    {
        // Truy vấn trực tiếp từ FeaturedJob, sắp xếp theo thứ tự
        $featuredJobs = FeaturedJob::orderBy('sort_order', 'asc') 
                            ->get(); // Lấy tất cả

        $recentJobs = Job::latest() 
                     ->take(6) 
                     ->get();
                    

        return view('page.index', compact('featuredJobs','recentJobs'));
    }

    public function about()
    {
        return view('page.about');
    }
}