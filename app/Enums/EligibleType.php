<?php

namespace App\Enums;
enum EligibleType: string
{
    case Education = 'Education';
    case Program = 'Program';
    case Activity = 'Activity';
    case Essay = 'Essay';
    case Mental = 'Mental';
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}