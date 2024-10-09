<?php

namespace App\Enums;

enum OrderStatus: string
{

    use HasStringValues;

    case NEW = 'new';
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';

}
