<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload; // ❗ Đảm bảo thêm Model Upload vào đây!

class UserController extends Controller
{
    // ... (Phương thức showUpload giữ nguyên)

    public function upload(Request $request)
    {
        $request->validate([
            'pdfFile' => 'required|file|mimes:pdf,doc,docx|max:5120', // chỉ cho pdf/doc/docx
        ]);

        $filePath = null;
        if ($request->hasFile('pdfFile')) {
            $file = $request->file('pdfFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $originalName = $file->getClientOriginalName(); // Lấy tên gốc để lưu

            // tạo thư mục nếu chưa có
            if (!file_exists(public_path('uploads/cv'))) {
                mkdir(public_path('uploads/cv'), 0777, true);
            }

            $file->move(public_path('uploads/cv'), $fileName);
            $filePath = 'uploads/cv/' . $fileName;

            // --- THAY ĐỔI TẠI ĐÂY: Lưu vào bảng uploads thay vì cập nhật user ---
            Upload::create([
                'user_id' => Auth::id(),
                'name' => $originalName, // Lưu tên gốc để hiển thị
                'path' => $filePath,    // Lưu đường dẫn file
            ]);
            // --------------------------------------------------------------------
        }

        // Xóa các dòng cập nhật 'cv_path' trên model User và Session (chúng ta không dùng cột này nữa)
        // $user = Auth::user();
        // if ($user) {
        //     $user->update(['cv_path' => $filePath]);
        // }
        // $sessionUser = Session::get('user', []);
        // $sessionUser['cv_path'] = $filePath;
        // Session::put('user', $sessionUser);

        return redirect()->route('profile.personal')->with('success', 'Upload CV thành công!');
    }

    public function personalInfo()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/register')->with('error', 'Vui lòng đăng ký hoặc đăng nhập trước.');
        }

        // Lấy TẤT CẢ các file đã tải lên của người dùng hiện tại
        // Sắp xếp theo thời gian mới nhất
        $uploadedFiles = Upload::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        // Truyền $uploadedFiles vào view
        return view('profile.personal', compact('user', 'uploadedFiles'));
    }

    // --- Phương thức MỚI để xem CV theo ID ---
    // public function viewcv($id)
    // {
    //     // Tìm file theo ID và đảm bảo file đó thuộc về người dùng đang đăng nhập
    //     $file = Upload::where('user_id', Auth::id())->findOrFail($id); 

    //     // Truyền thông tin file vào view xem CV
    //     return view('profile.personal', compact('file'));
    // }
}