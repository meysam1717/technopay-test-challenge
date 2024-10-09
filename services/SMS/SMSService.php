<?php

namespace Services\SMS;

interface SMSService
{

    public function sendSingle(SingleSMSDTO $dto): SendSingleSMSResponseDTO;

}
