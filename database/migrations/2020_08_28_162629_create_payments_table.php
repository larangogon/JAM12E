<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('status')->nullable();
            $table->string('requestId')->nullable();
            $table->string('internalReference')->nullable();
            $table->string('processUrl')->nullable();
            $table->string('message')->nullable();
            $table->string('document')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('locale')->nullable();
            $table->string('base')->default('p2p')->nullable();
            $table->float('amount', 14, 2)->nullable();
            $table->float('totalStore', 14, 2)->nullable();
            $table->unsignedBigInteger('order_id');


            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
