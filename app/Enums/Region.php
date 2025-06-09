<?php

namespace App\Enums;

enum Region : string
{
    case Ayeyarwady = 'Ayeyarwady';
    case Bago = 'Bago';
    case Magway = 'Magway';
    case Mandalay = 'Mandalay';
    case Sagaing = 'Sagaing';
    case Tanintharyi = 'Tanintharyi';
    case Yangon = 'Yangon';
    case Chin = 'Chin';
    case Kachin = 'Kachin';
    case Kayah = 'Kayah';
    case Kayin = 'Kayin';
    case Mon = 'Mon';
    case Rakhine = 'Rakhine';
    case Shan = 'Shan';
    case NayPyiTaw = 'NayPyiTaw';
    case Rohingya = 'Rohingya';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

}
