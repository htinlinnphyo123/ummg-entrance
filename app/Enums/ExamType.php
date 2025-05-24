<?php

namespace App\Enums;
enum ExamType: string
{
    case BEHS = 'BEHS';
    case BECA = 'BECA';
    case GED = 'GED';
    case IGCSE = 'IGCSE';
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}