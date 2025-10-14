<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Contract;

class ResumeController extends Controller
{
    public function review()
    {
        $userId = Auth::id();

        $about = About::where('user_id', $userId)->latest()->first();
        $educations = Education::where('user_id', $userId)->latest()->get();
        $experiences = Experience::where('user_id', $userId)->latest()->get();
        $contract = Contract::where('user_id', $userId)->latest()->first();

        return view('resume.review', compact('about', 'educations', 'experiences', 'contract'));
    }
}
