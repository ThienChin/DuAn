<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // nếu model user của bạn tên khác thì đổi lại
use App\Models\Aboutcv;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Contract;

class ProfileController extends Controller
{
    // Middleware để chắc chắn người dùng đã đăng nhập
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị thông tin cá nhân người dùng.   
     */
    public function show()
    {
        // Lấy user hiện tại
        $userId = Auth::id();
        
        $about = Aboutcv::where('user_id', $userId)->orderBy('id', 'desc')->first();   
        $educations = Education::where('user_id', $userId)->orderBy('id', 'desc')->first();
        $experiences = Experience::where('user_id', $userId)->orderBy('id', 'desc')->first();    
        $contract = Contract::where('user_id', $userId)->orderBy('id', 'desc')->first(); 


        // Gửi sang view để hiển thị thông tin
        return view('profile.show', compact('user','about', 'educations', 'experiences', 'contract'));
    }

    /**
     * Cập nhật thông tin cá nhân.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'phone', 'city', 'postal_code']));

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
