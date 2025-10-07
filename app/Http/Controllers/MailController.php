<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

use Illuminate\Http\Request;

class MailDemoController extends Controller
{
    public function send()
    {
        $to ='n24dvcn012@student.ptithcm.edu.vn';
        $username = 'Nguyen Van A';
        $attachmentPath = public_path('path/to/your/attachment.pdf'); // Đường dẫn tới file đính kèm (nếu có)
    
        Mail::to($to)->send(new WelcomeMail($username, $attachmentPath));
        return 'Đã gửi mail! Kiểm tra Inbox/Spam của bạn.';
    }
    
}