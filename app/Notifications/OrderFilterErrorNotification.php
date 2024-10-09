<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Services\SMS\SingleSMSDTO;

class OrderFilterErrorNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly string $message,
    )
    {
    }

    public function via(object $notifiable): array
    {
        return ['sms-fake', 'mail-fake'];
    }

    public function toSingleSMS(object $notifiable): SingleSMSDTO
    {
        return new SingleSMSDTO(
            phone: $notifiable->phone,
            message: $this->message,
        );
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Filter Error')
            ->greeting("Hello {$notifiable->name}")
            ->line($this->message);
    }


}
