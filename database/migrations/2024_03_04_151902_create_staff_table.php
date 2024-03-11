<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('position');
            $table->string('phone_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')->on('center');
            $table->softDeletes();
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
        Schema::dropIfExists('staff');
    }
}
