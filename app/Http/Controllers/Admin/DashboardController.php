<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm số lượng user và job trong database
        $totalUsers = DB::table('users')->count();
        $totalJobs = DB::table('jobs')->count();

        // Nếu muốn lấy danh sách gần đây (tùy chọn)
        $recentUsers = DB::table('users')->orderBy('id', 'desc')->limit(5)->get();
        $recentJobs = DB::table('jobs')->orderBy('id', 'desc')->limit(5)->get();

        // Truyền dữ liệu qua view
        return view('admin.dashboard', compact('totalUsers', 'totalJobs', 'recentUsers', 'recentJobs'));
    }
}
