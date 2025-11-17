<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidateName;
    public $companyName;
    public $jobTitle;
    public $customMessage;

    public function __construct($candidateName, $companyName, $jobTitle, $customMessage)
    {
        $this->candidateName = $candidateName;
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->customMessage = $customMessage;
    }

    public function build()
    {
        return $this->subject('Kết Quả Ứng Tuyển – ' . $this->jobTitle)
                    ->markdown('emails.applications.rejected');
    }
}
