<?php

namespace Services\SMS;

enum SendSMSStatus
{

    case SENT;
    case FAILED;
    case IN_QUEUE;

}
