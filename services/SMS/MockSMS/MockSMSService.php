<?php

namespace Services\SMS\MockSMS;

use Illuminate\Support\Facades\Log;
use Services\SMS\SendSingleSMSResponseDTO;
use Services\SMS\SendSMSStatus;
use Services\SMS\SingleSMSDTO;
use Services\SMS\SMSService;

final readonly class MockSMSService implements SMSService
{

    public function sendSingle(SingleSMSDTO $dto): SendSingleSMSResponseDTO
    {
        Log::info("Single SMS message was sent to phone: {$dto->getPhone()} with message: {$dto->getMessage()}");
        return new SendSingleSMSResponseDTO(
            status: SendSMSStatus::SENT
        );
    }

}
