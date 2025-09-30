<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function list()
    {
        return view('page.list');
    }

     public function detail()
    {
        return view('page.detail');
    }
}
