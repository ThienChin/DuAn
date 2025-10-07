<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    // Hiển thị form liên hệ
    public function showForm()
    {
        return view('emails.contact');
    }

    // Xử lý gửi mail

    public function send(Request $request)
    {
        $validated = $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);
        
        $data = [
            'name'    => $request->input('full-name'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
        ];

        // Gửi mail đúng chuẩn
        Mail::to('thiendz362@gmail.com')->send(new ContactMail($data));

        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
    }

}
