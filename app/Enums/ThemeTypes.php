<?php

namespace App\Enums;

enum ThemeTypes: string
{
    case BLUE = '#1967d2';
    case GREEN = '#1e8e3e';
    case PINK = '#e52592';
    case ORANGE = '#e8710a';
    case BLUETWO = '#129eaf';
    case PUPLE = '#9334e6';
    case BLUETHREE = '#4285f4';
    case GRAY = '#5f6368';

    public static function getRandomTheme(): self
    {
        $temes = self::cases();
        return $temes[array_rand($temes)];
    }
}
