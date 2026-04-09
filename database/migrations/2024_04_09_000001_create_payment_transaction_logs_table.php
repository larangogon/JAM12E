<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_transaction_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('order_id');

            $table->string('transaction_type'); // 'CREATE', 'UPDATE', 'REVERSE', 'REFUND', 'ERROR'
            $table->string('previous_status');
            $table->string('new_status');
            $table->string('previous_internal_reference')->nullable();
            $table->string('new_internal_reference')->nullable();

            // Datos de PlaceToPay
            $table->string('placetopay_request_id')->nullable();
            $table->string('placetopay_status')->nullable();
            $table->longText('placetopay_response')->nullable(); // JSON
            $table->longText('placetopay_request')->nullable(); // JSON (sin datos sensibles)

            // Montos
            $table->decimal('amount_before', 14, 2)->nullable();
            $table->decimal('amount_after', 14, 2)->nullable();

            // Información del usuario/sistema
            $table->unsignedBigInteger('user_id')->nullable(); // Usuario que realizó la acción
            $table->string('initiated_by')->default('system'); // 'system', 'user', 'webhook', 'scheduler'
            $table->string('ip_address')->nullable();

            // Información técnica
            $table->string('error_message')->nullable();
            $table->longText('error_details')->nullable(); // Stack trace si hay error
            $table->boolean('success')->default(true);
            $table->integer('retry_count')->default(0);

            // Auditoría
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->index('transaction_type');
            $table->index('new_status');
            $table->index('created_at');
            $table->index(['payment_id', 'created_at']);
            $table->index(['order_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transaction_logs');
    }
}
