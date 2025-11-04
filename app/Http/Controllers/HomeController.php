<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Loại bỏ use App\Models\Job; (Tùy chọn)
use App\Models\FeaturedJob; // Chỉ cần Model này

class HomeController extends Controller
{
    public function index()
    {
        // Truy vấn trực tiếp từ FeaturedJob, sắp xếp theo thứ tự
        $featuredJobs = FeaturedJob::orderBy('sort_order', 'asc') 
                            ->get(); // Lấy tất cả

        return view('page.index', compact('featuredJobs'));
    }

    public function about()
    {
        return view('page.about');
    }
}