<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNullTaxIdAndCategoryIdToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id")->nullable()->change();
            $table->unsignedBigInteger("tax_id")->nullable()->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id")->nullable(false)->change();
            $table->unsignedBigInteger("tax_id")->nullable(false)->change();
            //
        });
    }
}
