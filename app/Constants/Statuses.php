<?php

namespace App\Constants;

use Illuminate\Validation\Rules\Enum;

class Statuses extends Enum
{
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const PENDING = 'PENDING';
    public const PENDING_PAY = 'PENDING_PAY';
    public const PENDING_VALIDATION = 'PENDING_VALIDATION';
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const CANCELED = 'CANCELED';
    public const APPROVED_IN_STORE = 'APPROVED_IN_STORE';
    public const APPROVED_PARTIAL = 'APPROVED_PARTIAL';
    public const PARTIAL_EXPIRED = 'PARTIAL_EXPIRED';
    public const REFUNDED = 'REFUNDED';
    public const PARTIALLY_REFUNDED = 'PARTIALLY_REFUNDED';
    public const REFUND_PENDING = 'REFUND_PENDING';
    public const REFUND_FAILED = 'REFUND_FAILED';
    public const REVERSED = 'REVERSED';
    public const REVERSE_PENDING = 'REVERSE_PENDING';
    public const REVERSE_FAILED = 'REVERSE_FAILED';

    public const ERROR = 'ERROR';
    public const EXPIRED = 'EXPIRED';

    public static function values(): array
    {
        return [
            self::OK,
            self::FAILED,
            self::PENDING,
            self::PENDING_PAY,
            self::PENDING_VALIDATION,
            self::APPROVED,
            self::REJECTED,
            self::CANCELED,
            self::APPROVED_IN_STORE,
            self::APPROVED_PARTIAL,
            self::PARTIAL_EXPIRED,
            self::REFUNDED,
            self::PARTIALLY_REFUNDED,
            self::REFUND_PENDING,
            self::REFUND_FAILED,
            self::REVERSED,
            self::REVERSE_PENDING,
            self::REVERSE_FAILED,
            self::ERROR,
            self::EXPIRED,
        ];
    }

    public static function finalStates(): array
    {
        return [
            self::APPROVED,
            self::REJECTED,
            self::CANCELED,
            self::REFUNDED,
            self::REVERSED,
            self::ERROR,
            self::EXPIRED,
        ];
    }

    public static function successStates(): array
    {
        return [
            self::APPROVED,
            self::APPROVED_IN_STORE,
            self::APPROVED_PARTIAL,
        ];
    }

    public static function failureStates(): array
    {
        return [
            self::REJECTED,
            self::CANCELED,
            self::FAILED,
            self::ERROR,
            self::EXPIRED,
            self::REFUND_FAILED,
            self::REVERSE_FAILED,
        ];
    }

    public static function isPending(string $status): bool
    {
        return in_array($status, [
            self::PENDING,
            self::PENDING_PAY,
            self::PENDING_VALIDATION,
            self::REFUND_PENDING,
            self::REVERSE_PENDING,
        ]);
    }

    public static function isFinal(string $status): bool
    {
        return in_array($status, self::finalStates());
    }

    public static function isSuccess(string $status): bool
    {
        return in_array($status, self::successStates());
    }
}
