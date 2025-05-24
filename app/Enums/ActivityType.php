<?php

namespace App\Enums;
enum ActivityType: int
{
    case One = 1;
    case Two = 2;
    case Three = 3;
    case Four = 4;
    public function getLabels() : array
    {
        return [
            self::One => '1',
            self::Two => '2',
            self::Three => '3',
            self::Four => '4',
        ];
    }
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

}