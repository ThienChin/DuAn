<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('emails.contact');
    }

    public function send(Request $request)
    {
         $request->validate([
            'full-name'    => 'required|string|max:255',
            'email'   => 'required|email',
        //     'phone'   => 'nullable|string|max:15',
        //     'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // $to = 'thiendz362@gmail.com';
        // $attachmentPath = public_path('path/to/your/attachment.pdf'); // Không có file đính kèm trong trường hợp này


    // Mail::send('emails.contact', [
    //     'name'    => $request->input('full-name'),
    //     'message' => $request->input('message'),
    //     'email'   => $request->input('email'),
    // ], function ($m) use ($request) {
    //     $m->to('thiendz362@gmail.com')   // Email admin nhận
    //     ->replyTo($email, $name)    // Người dùng nhập ở form
    //     ->subject('Liên hệ từ website');
    // });
        try {
        Mail::send('emails.contact', [
            'name'    => $request->input('full-name'),
            'message' => $request->input('message'),
            'email'   => $request->input('email'),
        ], function ($m) use ($request) {
            $m->to('thiendz362@gmail.com')
            ->replyTo($request->input('email'), $request->input('full-name'))
            ->subject('Liên hệ từ website');
        });
        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
    } catch (\Exception $e) {
        \Log::error('Email sending failed: ' . $e->getMessage());
        return back()->with('error', 'Có lỗi xảy ra khi gửi email. Vui lòng thử lại sau.');
    }
            return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.');
        }
    
    }
