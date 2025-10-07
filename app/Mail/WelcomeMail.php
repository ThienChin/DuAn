<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $username;
    public ?string $attachmentPath = null;

    /**
     * Tạo instance mới.
     */
    public function __construct(string $username, ?string $attachmentPath = null)
    {
        $this->username = $username;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Cấu hình phần envelope (thông tin người gửi & tiêu đề)
     */
    public function envelope(): Envelope
    {
        // Fallback an toàn nếu .env chưa load
        $fromAddress = env('MAIL_FROM_ADDRESS', 'no-reply@example.com');
        $fromName = env('MAIL_FROM_NAME', config('app.name', 'Laravel App'));

        return new Envelope(
            from: new Address($fromAddress, $fromName),
            subject: 'Welcome to ' . config('app.name', 'Our Website')
        );
    }

    /**
     * Cấu hình nội dung email (view + dữ liệu)
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'username' => $this->username,
            ]
        );
    }

    /**
     * File đính kèm (nếu có)
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->attachmentPath && file_exists($this->attachmentPath)) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath($this->attachmentPath);
        }

        return $attachments;
    }
}
