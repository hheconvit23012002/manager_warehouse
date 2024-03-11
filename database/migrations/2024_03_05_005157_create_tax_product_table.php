<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_product', function (Blueprint $table) {
            $table->id();
            $table->double('number')->unique();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')->on('center');
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
        Schema::dropIfExists('tax_product');
    }
}
