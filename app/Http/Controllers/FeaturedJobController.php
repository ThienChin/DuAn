<?php

namespace App\Http\Controllers;

use App\Models\FeaturedJob;
use Illuminate\Http\Request;

class FeaturedJobController extends Controller
{
    // Lấy danh sách Featured Jobs
    public function index()
    {
        $featuredJobs = FeaturedJob::with('job')
                            ->orderBy('sort_order')
                            ->get();

        return view('featured.index', compact('featuredJobs'));
    }

    // Admin approve job thành Featured
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'sort_order' => 'nullable|integer',
        ]);

        FeaturedJob::create([
            'job_id' => $request->job_id,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Job has been featured.');
    }

    // Admin remove Featured
    public function destroy($id)
    {
        $featuredJob = FeaturedJob::findOrFail($id);
        $featuredJob->delete();

        return redirect()->back()->with('success', 'Featured job removed.');
    }
}