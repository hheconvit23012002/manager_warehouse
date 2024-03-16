<?php

use App\Models\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->string('email')->unique()->nullable();
            $table->string('position');
            $table->string('phone_number')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('status');
            $table->unsignedBigInteger('center_id')->nullable();
            $table->foreign('center_id')->references('id')->on('center');
            $table->softDeletes();
            $table->timestamps();
        });
        Staff::create([
            'position' => Staff::POSITION_SUPPER_ADMIN,
            'username' => 'spadmin',
            'password' => Hash::make(1),
            'status' => Staff::STATUS_ACTIVE
        ]);
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
