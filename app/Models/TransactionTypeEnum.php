<?php

namespace App\Models;

// a Laravel specific base class
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DEBIT()
 * @method static self CREDIT()
 */
final class TransactionTypeEnum extends Enum {
    protected static function labels(): array
    {
        return [
            'DEBIT' => 'debit',
            'CREDIT' => 'credit',
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
