<?php

namespace Services\Mail;

enum MailSendStatus
{

    case SENT;
    case FAILED;
    case IN_QUEUE;

}
