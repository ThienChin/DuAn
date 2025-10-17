<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function Upload()
    {
        return view('create_cv.upload');
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('pdfFile')) {
            return back()->with('error', 'No file selected.');
        }

        $file = $request->file('pdfFile');
        if (!$file->isValid()) {
            return back()->with('error', 'Upload error.');
        }

        $ext = strtolower($file->getClientOriginalExtension());
        if ($ext !== 'pdf') {
            return back()->with('error', 'Only PDF files are allowed.');
        }

        $targetDir = public_path('uploads');
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = $file->getClientOriginalName();
        $file->move($targetDir, $fileName);

        return back()->with('success', 'Your CV has been uploaded successfully!');
    }
}
