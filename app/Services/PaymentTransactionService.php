<?php

namespace App\Services;

use App\Constants\Statuses;
use App\Entities\Payment;
use App\Entities\PaymentTransactionLog;
use Illuminate\Support\Facades\Log;

class PaymentTransactionService
{
    public function logTransaction(
        Payment $payment,
        string $transactionType,
        string $newStatus,
        array $options = []
    ): PaymentTransactionLog {
        $previousStatus = $payment->status;

        $logData = [
            'payment_id' => $payment->id,
            'order_id' => $payment->order_id,
            'transaction_type' => $transactionType,
            'previous_status' => $previousStatus,
            'new_status' => $newStatus,
            'previous_internal_reference' => $payment->internalReference,
            'amount_before' => $payment->amount,
            'amount_after' => $options['amount_after'] ?? $payment->amount,
            'placetopay_request_id' => $options['request_id'] ?? null,
            'placetopay_status' => $options['placetopay_status'] ?? null,
            'placetopay_response' => $options['response'] ?? null,
            'placetopay_request' => $options['request'] ?? null,
            'user_id' => auth()->id(),
            'initiated_by' => $options['initiated_by'] ?? 'system',
            'ip_address' => request()->ip(),
            'error_message' => $options['error'] ?? null,
            'error_details' => $options['error_details'] ?? null,
            'success' => $options['success'] ?? true,
            'retry_count' => $options['retry_count'] ?? 0,
        ];

        if (isset($options['new_internal_reference'])) {
            $logData['new_internal_reference'] = $options['new_internal_reference'];
        }

        $log = PaymentTransactionLog::create($logData);

        Log::info('Payment transaction logged', [
            'log_id' => $log->id,
            'transaction_type' => $transactionType,
            'payment_id' => $payment->id,
            'order_id' => $payment->order_id,
            'status_change' => "{$previousStatus} → {$newStatus}",
        ]);

        return $log;
    }

    public function updatePaymentStatus(
        Payment $payment,
        string $newStatus,
        string $transactionType = 'UPDATE',
        array $updateData = [],
        array $logOptions = []
    ): bool {
        $previousStatus = $payment->status;

        try {
            if (!$this->isValidTransition($previousStatus, $newStatus, $transactionType)) {
                Log::warning('Invalid payment status transition', [
                    'payment_id' => $payment->id,
                    'from' => $previousStatus,
                    'to' => $newStatus,
                    'type' => $transactionType,
                ]);

                return false;
            }

            $payment->update(array_merge(['status' => $newStatus], $updateData));

            $this->logTransaction($payment, $transactionType, $newStatus, $logOptions);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to update payment status', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->logTransaction($payment, $transactionType, $previousStatus, array_merge($logOptions, [
                'error' => $e->getMessage(),
                'error_details' => $e->getTraceAsString(),
                'success' => false,
            ]));

            return false;
        }
    }

    public function refundPayment(Payment $payment, ?float $refundAmount = null, array $options = []): bool
    {
        if ($refundAmount && $refundAmount < $payment->amount) {
            return $this->updatePaymentStatus(
                $payment,
                Statuses::PARTIALLY_REFUNDED,
                'REFUND',
                ['amount' => $payment->amount - $refundAmount],
                array_merge($options, ['amount_after' => $payment->amount - $refundAmount])
            );
        }

        return $this->updatePaymentStatus(
            $payment,
            Statuses::REFUNDED,
            'REFUND',
            [],
            $options
        );
    }

    public function reversePayment(Payment $payment, array $options = []): bool
    {
        return $this->updatePaymentStatus(
            $payment,
            Statuses::REVERSED,
            'REVERSE',
            [],
            $options
        );
    }

    private function isValidTransition(string $from, string $to, string $transactionType = 'UPDATE'): bool
    {
        if (Statuses::isFinal($from)) {
            return false;
        }

        $validTransitions = [
            'CREATE' => [
                Statuses::PENDING => [Statuses::PENDING, Statuses::APPROVED, Statuses::REJECTED],
            ],
            'UPDATE' => [
                Statuses::PENDING => [Statuses::APPROVED, Statuses::REJECTED, Statuses::PENDING_VALIDATION],
                Statuses::PENDING_VALIDATION => [Statuses::APPROVED, Statuses::REJECTED],
                Statuses::PENDING_PAY => [Statuses::APPROVED, Statuses::REJECTED],
                Statuses::APPROVED_PARTIAL => [Statuses::APPROVED, Statuses::EXPIRED],
            ],
            'REVERSE' => [
                Statuses::APPROVED => [Statuses::REVERSED, Statuses::REVERSE_PENDING, Statuses::REVERSE_FAILED],
                Statuses::APPROVED_IN_STORE => [Statuses::REVERSED, Statuses::REVERSE_PENDING, Statuses::REVERSE_FAILED],
                Statuses::APPROVED_PARTIAL => [Statuses::REVERSED, Statuses::REVERSE_PENDING, Statuses::REVERSE_FAILED],
            ],
            'REFUND' => [
                Statuses::APPROVED => [Statuses::REFUNDED, Statuses::PARTIALLY_REFUNDED, Statuses::REFUND_PENDING, Statuses::REFUND_FAILED],
                Statuses::APPROVED_PARTIAL => [Statuses::REFUNDED, Statuses::PARTIALLY_REFUNDED, Statuses::REFUND_PENDING, Statuses::REFUND_FAILED],
            ],
            'ERROR' => [
                Statuses::PENDING => [Statuses::ERROR],
                Statuses::PENDING_VALIDATION => [Statuses::ERROR],
                Statuses::PENDING_PAY => [Statuses::ERROR],
            ],
        ];

        $transitionKey = $validTransitions[$transactionType][$from] ?? null;

        return $transitionKey && in_array($to, $transitionKey);
    }

    public function getPaymentHistory(int $paymentId)
    {
        return PaymentTransactionLog::getPaymentHistory($paymentId);
    }

    public function getOrderHistory(int $orderId)
    {
        return PaymentTransactionLog::getOrderHistory($orderId);
    }

    public function getFailedTransactionsPendingRetry()
    {
        return PaymentTransactionLog::getFailedTransactionsPendingRetry();
    }

    public function incrementRetryCount(PaymentTransactionLog $log): void
    {
        $log->increment('retry_count');
    }
}
