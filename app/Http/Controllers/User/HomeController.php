<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job; // Chỉ cần Model này

class HomeController extends Controller
{
    public function index()
    {
        $recentJobs = Job::latest() 
                     ->take(6) 
                     ->get();
                    

        return view('page.index', compact('recentJobs'));
    }

    public function about()
    {
        return view('page.about');
    }
}