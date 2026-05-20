<?php

namespace App\Enums;

enum PageCategory: string
{
    case Solutions = 'solutions';
    case Industries = 'industries';

    public function label(): string
    {
        return match($this) {
            self::Solutions => 'Solutions',
            self::Industries => 'Industries',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->all();
    }
}
