<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTransactionLog extends Model
{
    use SoftDeletes;

    protected $table = 'payment_transaction_logs';

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public static function getOrderHistory(int $orderId)
    {
        return static::where('order_id', $orderId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public static function getPaymentHistory(int $paymentId)
    {
        return static::where('payment_id', $paymentId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public static function getFailedTransactionsPendingRetry()
    {
        return static::where('success', false)
            ->where('retry_count', '<', 3)
            ->whereIn('transaction_type', ['REVERSE', 'REFUND'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getAuditMessage(): string
    {
        return sprintf(
            '%s: %s → %s (Pago #%d, Orden #%d) por %s',
            $this->transaction_type,
            $this->previous_status,
            $this->new_status,
            $this->payment_id,
            $this->order_id,
            $this->initiated_by
        );
    }
}
