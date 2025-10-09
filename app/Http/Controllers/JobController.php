<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();

        if ($request->has('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->has('salary')) {
            $salaryRange = explode('-', $request->salary);
            if (count($salaryRange) == 2) {
                $query->whereBetween('salary', [$salaryRange[0], $salaryRange[1]]);
            }
        }
        if ($request->has('level')) {
            $query->where('category', 'like', '%' . $request->level . '%');
        }
        if ($request->has('remote')) {
            // Thêm logic nếu có cột remote
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('posted_at', 'desc');
                    break;
                case 'salary':
                    $query->orderBy('salary', 'desc');
                    break;
                case 'internship':
                    $query->where('category', 'like', '%Internship%');
                    break;
            }
        } else {
            $query->orderBy('posted_at', 'desc');
        }

        $jobs = $query->paginate(6);
        return view('page.list', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }
}