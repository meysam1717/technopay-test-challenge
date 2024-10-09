<?php

namespace Services\Mail\MockMail;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Services\Mail\MailSendResponseDTO;
use Services\Mail\MailSendStatus;
use Services\Mail\MailService;

class MockMailService implements MailService
{
    public function send(MailMessage $mailMessage): MailSendResponseDTO
    {
        $mailMessageData = json_encode($mailMessage->toArray());
        Log::info("Mail message sent to \n $mailMessageData");
        return new MailSendResponseDTO(
            status: MailSendStatus::SENT
        );
    }

}
