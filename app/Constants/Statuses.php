<?php

namespace App\Constants;

use Illuminate\Validation\Rules\Enum;

class Statuses extends Enum
{
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const PENDING = 'PENDING';
    public const CANCELED = 'CANCELED';
    public const PENDING_PAY = 'PENDING_PAY';
    public const APPROVED_IN_STORE = 'APPROVED_IN_STORE';
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const APPROVED_PARTIAL = 'APPROVED_PARTIAL';
    public const PARTIAL_EXPIRED = 'PARTIAL_EXPIRED';
    public const PENDING_VALIDATION = 'PENDING_VALIDATION ';
    public const REFUNDED = 'REFUNDED';

    public static function values(): array
    {
        return [
            self::APPROVED,
            self::REJECTED,
            self::PENDING,
            self::CANCELED,
            self::PENDING_PAY,
            self::APPROVED_IN_STORE,
            self::APPROVED_PARTIAL,
            self::PENDING_VALIDATION,
            self::REFUNDED,
            self::FAILED,
            self::PARTIAL_EXPIRED,
        ];
    }
}
