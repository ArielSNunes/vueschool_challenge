<?php

namespace App\Enums;

enum TimezoneEnum: string
{
    case CET = 'CET';
    case CST = 'CST';
    case GMT1 = 'GMT+1';

    public static function getValues(): array
    {
        return array_map(
            fn($enum) => $enum->value,
            self::cases()
        );
    }
}
