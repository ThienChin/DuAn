<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;

class ContractController extends Controller
{
    public function create()
    {
        return view('create_cv.contract');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $validated['user_id'] = Auth::id();

        Contract::create($validated);

        return redirect()->route('experience.create')->with('success', 'Thông tin liên hệ đã lưu!');
    }
}
