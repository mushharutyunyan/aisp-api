<?php

namespace App\Models;

// a Laravel specific base class
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self USD()
 * @method static self GBP()
 * @method static self EUR()
 * @method static self RUB()
 */
final class CurrencyEnum extends Enum {
    protected static function labels(): array
    {
        return [
            'USD' => 'usd',
            'GBP' => 'gbp',
            'EUR' => 'eur',
            'RUB' => 'rub',
        ];
    }

    /**
     * @return string[]
     * @psalm-return array<string|int, string>
     */
    public static function toOptions(): array
    {
        $array = [];

        foreach (static::toArray() as $key => $value) {
            $array[] = [
                'key' => $key,
                'value' => $value
            ];
        }

        return $array;
    }
}
