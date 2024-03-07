<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id');
            $table->string('shipping_address');
            $table->unsignedBigInteger('seller_id');
            $table->string('phone_number');
            $table->text('desc')->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->string('status');
            $table->foreign('request_id')->references('id')->on('center');
            $table->foreign('seller_id')->references('id')->on('center');
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
        Schema::dropIfExists('order');
    }
}
