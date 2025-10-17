<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị danh sách user
    public function dashboard()
    {
        // Nếu bạn muốn có thêm thống kê, ví dụ:
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Trả view admin.dashboard.blade.php (hoặc tùy bạn có view sẵn)
        return view('admin.dashboard', compact('totalUsers', 'totalAdmins'));
    }

    // Cập nhật role
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật quyền thành công!');
    }
}
