<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to(config('app.telegram_chat_id'))
            ->content('ini adalah amaran !!!! ><');
    }
}