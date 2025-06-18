<?php

namespace App\Enums;
enum ExamType: string
{
    case BEHS = 'BEHS';
    case BECA = 'BECA';
    case GED = 'GED';
    case IGCSE = 'IGCSE';
    case ETHNICAL = 'ETHNICAL';
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
    public static function getLabel() : array
    {
        return [
            'BEHS' => 'BEHS',
            'BECA' => 'BECA',
            'GED' => 'GED',
            'IGCSE' => 'IGCSE',
            'ETHNICAL' => 'ETHNICAL',
        ];
    }
}