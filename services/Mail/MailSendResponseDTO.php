<?php

namespace Services\Mail;

final readonly class MailSendResponseDTO
{

    public function __construct(
        private MailSendStatus $status,
        private ?string        $message = null,
    )
    {
    }

    public function getStatus(): MailSendStatus
    {
        return $this->status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

}
