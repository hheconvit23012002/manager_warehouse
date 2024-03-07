<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('measurement_unit');// đơn vị tính tieenf
            $table->double('price');
            $table->unsignedBigInteger('category_id');
            $table->text('des')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('tax_id');
            $table->unsignedBigInteger('center_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('created_id')->references('id')->on('account');
            $table->foreign('tax_id')->references('id')->on('tax_product');
            $table->foreign('center_id')->references('id')->on('center');
            $table->softDeletes();
//            $table->integer('number');
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
        Schema::dropIfExists('product');
    }
}
