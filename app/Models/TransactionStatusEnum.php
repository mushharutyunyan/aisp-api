<?php

namespace App\Models;

// a Laravel specific base class
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self PENDING()
 * @method static self ONHOLD()
 * @method static self PAID()
 * @method static self CANCELED()
 */
final class TransactionStatusEnum extends Enum {
    protected static function labels(): array
    {
        return [
            'PENDING' => 'pending',
            'ONHOLD' => 'onhold',
            'PAID' => 'paid',
            'CANCELED' => 'canceled',
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
