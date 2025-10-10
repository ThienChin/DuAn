<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        return view('create_cv.contract');
    }

    public function store(Request $request)
    {
        // ✅ VALIDATE DỮ LIỆU
        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'city'         => 'nullable|string|max:100',
            'postal_code'  => 'nullable|numeric|digits_between:4,10',
            'phone'        => 'nullable|string|max:20|regex:/^[0-9+\-\s]+$/',
            'email'        => 'required|email|max:255',
        ], [
            // 🔸 THÔNG BÁO LỖI TÙY CHỈNH (TIẾNG VIỆT)
            'first_name.required'  => 'Vui lòng nhập First Name.',
            'last_name.required'   => 'Vui lòng nhập Last Name.',
            'email.required'       => 'Vui lòng nhập Email.',
            'email.email'          => 'Email không đúng định dạng.',
            'postal_code.numeric'  => 'Postal Code chỉ được chứa số.',
            'phone.regex'          => 'Số điện thoại chỉ được chứa số, khoảng trắng hoặc dấu + -.',
        ]);

        // ✅ LƯU VÀO DATABASE
       $contract = Contract::create([
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
            'phone'       => $request->phone,
            'email'       => $request->email,
        ]);

        return redirect()->route('create_cv.experience');
    }
}
