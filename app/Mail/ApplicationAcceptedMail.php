<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\JobApplication; 
use Carbon\Carbon; // Bắt buộc phải có



class ApplicationAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobApplication $application;
    public array $interviewDetails; 

    public function __construct(JobApplication $application, array $interviewDetails) 
    {
        $this->application = $application;
        $this->interviewDetails = $interviewDetails;
        $this->application->load('job'); 
        $this->interviewDetails['customMessage'] = $this->interviewDetails['customMessage'] ?? '';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Chúc Mừng! Thư Mời Phỏng Vấn Chính Thức từ ' . ($this->application->job->company_name ?? 'Công ty'),
        );
    }

    public function content(): Content
    {
        $job = $this->application->job;
        $interviewDate = $this->interviewDetails['interview_date'] ?? null;
        $interviewTime = $this->interviewDetails['interview_time'] ?? 'Chưa xác định (Vui lòng liên hệ)';
        $interviewLocation = $this->interviewDetails['interview_location'] ?? 'Chưa xác định (Địa chỉ công ty)';
        $customMessage = $this->interviewDetails['message'] ?? ''; 
        
        // Định dạng ngày an toàn
        $formattedDate = $interviewDate 
            ? Carbon::parse($interviewDate)->format('d/m/Y') 
            : 'Chưa xác định';


        return new Content(
            markdown: 'emails.applications.accepted',
            with: [
                'candidateName' => $this->application->name,
                'jobTitle' => $job->title ?? 'Vị trí không xác định',
                'companyName' => $job->company_name ?? 'Công ty Tuyển dụng',
                
                // ✨ TRUYỀN DỮ LIỆU ĐÃ XỬ LÝ
                'interviewDate' => $formattedDate,
                'interviewTime' => $interviewTime,
                'interviewLocation' => $interviewLocation,
                'customMessage' => $customMessage, 
            ],
        );
    }
}