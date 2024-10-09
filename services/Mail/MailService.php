<?php

namespace Services\Mail;

use Illuminate\Notifications\Messages\MailMessage;

interface MailService
{

    public function send(MailMessage $mailMessage): MailSendResponseDTO;

}
