<?php

namespace App\Notifications\Channles;

use App\Services\HadaraSms;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class HadaraSmsChannel
{
    public function send(object $notifiable, Notification $notification)
    {
        $service = new HadaraSms(Config::get('services.hadara.key'));
        $service->send(
            $notifiable->routeNotificationForHadara(),
            $notification->toHadara($notifiable),
        );
    }
}
