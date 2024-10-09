<?php

namespace App\Channels;

use Services\SMS\SingleSMSDTO;
use Services\SMS\SMSService;

readonly class SMSChannel
{

    public function __construct(
        private SMSService $service,
    )
    {
    }

    public function send($notifiable, $notification): void
    {
        if (method_exists($notification, 'toSingleSMS')) {

            /** @var SingleSMSDTO $singleSMSDTO */
            $singleSMSDTO = $notification->toSingleSMS($notifiable);

            $this->service->sendSingle(dto: $singleSMSDTO);
        }

    }

}
