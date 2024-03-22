<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeUniqueColumnOnTaxProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_product', function (Blueprint $table) {
            $table->dropUnique(['number']);
            $table->unique(['number','center_id']);
            //
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_product', function (Blueprint $table) {
            $table->unique('number');
            //
        });
        //
    }
}
