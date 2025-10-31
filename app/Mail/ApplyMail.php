<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $jobTitle;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct($jobTitle, $userName)
    {
        $this->jobTitle = $jobTitle;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Cảm ơn bạn đã ứng tuyển!')
                    ->view('emails.apply_thank')
                    ->with([
                        'jobTitle' => $this->jobTitle,
                        'userName' => $this->userName,
                    ]);
    }
}
