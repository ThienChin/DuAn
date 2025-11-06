<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\WelcomeNotification;

class SendWelcomeNotification
{
    public function handle(UserRegistered $event)
    {
        $event->user->notify(new WelcomeNotification());
    }
}