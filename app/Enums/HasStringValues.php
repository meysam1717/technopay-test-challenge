<?php

namespace App\Enums;

trait HasStringValues
{

    /** @return array<string> */
    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

}
