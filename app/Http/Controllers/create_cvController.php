<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class create_cvController extends Controller
{
    public function contract()
    {
        return view('create_cv.contract');
    }
        
    public function experience()
    {
        return view('create_cv.experience');
    }
        
    public function education()
    {
        return view('create_cv.education');
    }
        
    public function aboutcv()
    {
        return view('create_cv.about');
    }
     
     public function resume()
    {
        return view('create_cv.resume');
    }
}
