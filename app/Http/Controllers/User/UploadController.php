<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function upload()
    {
        $cvPath = Session::get('current_cv');
        return view('create_cv.upload', compact('cvPath'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pdfFile' => 'required|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Xóa file cũ nếu có
        $oldFile = Session::get('current_cv');
        if ($oldFile && File::exists(public_path($oldFile))) {
            File::delete(public_path($oldFile));
        }

        // Upload file mới
        $file = $request->file('pdfFile');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $fileName);
        $filePath = 'uploads/' . $fileName;

        // Cập nhật session
        Session::put('current_cv', $filePath);

        return redirect()->route('upload.form')->with('success', 'File uploaded successfully!');
    }
}
