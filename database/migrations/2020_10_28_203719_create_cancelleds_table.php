<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelleds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('status')->default('CANCELADO');
            $table->unsignedBigInteger('user_id');
            $table->boolean('shippingStatus')->default(false);
            $table->string('description')->nullable();
            $table->text('statusTransaction')->nullable();
            $table->string('requestId')->nullable();
            $table->string('internalReference')->nullable();
            $table->string('processUrl')->nullable();
            $table->string('message')->nullable();
            $table->string('document')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('locale')->nullable();
            $table->float('amountReturn', 14, 2)->nullable();
            $table->unsignedBigInteger('order_id');
            $table->integer('totalOrder');
            $table->unsignedBigInteger('cancelled_by')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('cancelled_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('cancelleds');
    }
}
