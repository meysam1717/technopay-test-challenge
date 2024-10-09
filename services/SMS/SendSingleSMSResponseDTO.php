<?php

namespace Services\SMS;

final readonly class SendSingleSMSResponseDTO
{

    public function __construct(
        private SendSMSStatus $status,
        private ?string       $message = null,
    )
    {
    }

    public function getStatus(): SendSMSStatus
    {
        return $this->status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

}
