<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_recipient');
            $table->string('phone_recipient');
            $table->string('cellphone_recipient');
            $table->string('document_recipient');
            $table->string('address_recipient');
            $table->string('email_recipient');
            $table->string('country_recipient');
            $table->string('city_recipient');
            $table->unsignedBigInteger('order_id')->unique();

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
        Schema::dropIfExists('shippings');
    }
}
