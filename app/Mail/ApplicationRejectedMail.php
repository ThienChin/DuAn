<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\JobApplication;
use Carbon\Carbon; // Bắt buộc phải có

class ApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public JobApplication $application;
    public string $customMessage;

    public function __construct(JobApplication $application, string $customMessage = '') 
    {
        $this->application = $application;
        $this->application->load('job'); 
        $this->customMessage = $customMessage ?? '';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kết quả hồ sơ ứng tuyển tại ' . ($this->application->job->company_name ?? 'Công ty'),
        );
    }

    public function content(): Content
    {
        $job = $this->application->job;
        
        return new Content(
            markdown: 'emails.applications.rejected',
            with: [
                'candidateName' => $this->application->name,
                'jobTitle' => $job->title ?? 'Vị trí không xác định',
                'companyName' => $job->company_name ?? 'Công ty Tuyển dụng',
                'customMessage' => $this->customMessage,
            ],
        );
    }
}
