<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidateName;
    public $companyName;
    public $jobTitle;
    public $customMessage;
    public $interviewDate;
    public $interviewTime;
    public $interviewLocation;

    public function __construct($candidateName, $companyName, $jobTitle, $customMessage, $interviewDate, $interviewTime, $interviewLocation)
    {
        $this->candidateName = $candidateName;
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->customMessage = $customMessage;
        $this->interviewDate = $interviewDate;
        $this->interviewTime = $interviewTime;
        $this->interviewLocation = $interviewLocation;
    }

    public function build()
    {
        return $this->subject('Thư Mời Phỏng Vấn – ' . $this->jobTitle)
                    ->markdown('emails.applications.accepted');
    }
}
