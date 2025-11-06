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
        // ✅ Validate dữ liệu đầu vào
        $validated = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'city'         => 'nullable|string|max:100',
            'postal_code'  => 'nullable|numeric|digits_between:4,10',
            'phone'        => 'nullable|string|max:20|regex:/^[0-9+\-\s]+$/',
            'email'        => 'required|email|max:255',
            'photo_url'    => 'nullable|url|max:255',
        ]);

        // ✅ Gán user_id nếu có đăng nhập
        $validated['user_id'] = Auth::id();

        // ✅ Nếu không đăng nhập mà cột user_id không cho null → sẽ lỗi
        // Nên ta kiểm tra trước
        if (!$validated['user_id']) {
            return redirect()->back()
                ->withErrors(['auth' => 'Bạn cần đăng nhập để lưu thông tin liên hệ.'])
                ->withInput();
        }

        // ✅ Lưu dữ liệu
        Contract::create($validated);

        return redirect()->route('create_cv.experience')
            ->with('success', 'Thông tin liên hệ đã được lưu thành công!');
    }
}
