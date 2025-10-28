<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // ❗ ĐÃ THÊM: Cần thiết cho việc xóa file vật lý
use App\Models\Upload; 

class UserController extends Controller
{
    // ... (Phương thức showUpload giữ nguyên nếu có)

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

            // --- Lưu vào bảng uploads ---
            Upload::create([
                'user_id' => Auth::id(),
                'name' => $originalName, // Lưu tên gốc để hiển thị
                'path' => $filePath,    // Lưu đường dẫn file
            ]);
            // --------------------------------------------------------------------
        }

        return redirect()->route('profile.personal')->with('success', 'Upload CV thành công!');
    }

    public function personalInfo()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/register')->with('error', 'Vui lòng đăng ký hoặc đăng nhập trước.');
        }

        // Lấy TẤT CẢ các file đã tải lên của người dùng hiện tại
        $uploadedFiles = Upload::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        
        return view('profile.personal', compact('user', 'uploadedFiles'));
    }

    // 🌟 PHƯƠNG THỨC ĐÃ THÊM: HIỂN THỊ TRANG XÁC NHẬN XÓA (dẫn đến delete.blade.php)
    public function confirmDeleteCv($id)
    {
        // Tìm file và đảm bảo nó thuộc về người dùng hiện tại
        $file = Upload::where('user_id', Auth::id())->find($id);

        if (!$file) {
            return redirect()->route('profile.personal')->with('error', 'File CV không tồn tại hoặc bạn không có quyền truy cập.');
        }

        // Trả về view profile/delete.blade.php
        return view('profile.delete', compact('file'));
    }
    
    // PHƯƠNG THỨC THỰC HIỆN XÓA
    public function deleteCv($id)
    {
        // 1. Tìm bản ghi và đảm bảo nó thuộc về người dùng hiện tại (bảo mật)
        $upload = Upload::where('user_id', Auth::id())->find($id);

        if (!$upload) {
            return redirect()->route('profile.personal')->with('error', 'File CV không tồn tại hoặc bạn không có quyền xóa.');
        }

        $filePath = public_path($upload->path);

        // 2. Xóa file vật lý khỏi server
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // 3. Xóa bản ghi trong Database
        $upload->delete();

        return redirect()->route('profile.personal')->with('success', 'CV đã được xóa thành công! Vui lòng tải lên CV mới nếu cần.');
    }
}