<?php

namespace App\Channels;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Services\Mail\MailService;
use Services\SMS\SingleSMSDTO;
use Services\SMS\SMSService;

readonly class MailChannel
{

    public function __construct(
        private MailService $service,
    )
    {
    }

    public function send($notifiable, $notification): void
    {
        if (method_exists($notification, 'toMail')) {

            /** @var MailMessage $mailMessage */
            $mailMessage = $notification->toMail($notifiable);

            $this->service->send(mailMessage: $mailMessage);
        }

    }

}
