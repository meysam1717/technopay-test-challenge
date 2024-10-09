<?php

namespace App\Enums;

enum UserRole: string
{

    use HasStringValues;

    case ADMIN = 'admin';
    case USER = 'user';

}
