<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // Lưu vào DB để hiển thị ở chuông
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Chào mừng bạn đến với Gotto Job! 🎉',
            'url' => route('page.index'),
            'icon' => 'fa-user-plus',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Chào mừng đến với Gotto Job!')
                    ->line('Cảm ơn bạn đã tham gia cộng đồng việc làm lớn nhất.')
                    ->action('Vào trang chủ', route('page.index'));
    }
}