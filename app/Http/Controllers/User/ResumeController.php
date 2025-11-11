<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Aboutcv;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Contract;

class ResumeController extends Controller
{
    public function review()
    {
        $userId = Auth::id();

        $about = Aboutcv::where('user_id', $userId)->orderBy('id', 'desc')->first();   
        $educations = Education::where('user_id', $userId)->orderBy('id', 'desc')->first();
        $experiences = Experience::where('user_id', $userId)->orderBy('id', 'desc')->first();    
        $contract = Contract::where('user_id', $userId)->orderBy('id', 'desc')->first(); 

        return view('create_cv.resume', compact('about', 'educations', 'experiences', 'contract'));
    }
}
