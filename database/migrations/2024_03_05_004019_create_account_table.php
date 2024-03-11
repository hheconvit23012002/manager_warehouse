<?php

use App\Models\Account;
use App\Models\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->string('status');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->softDeletes();
            $table->timestamps();
        });
        $staff = Staff::create([
            'position' => Staff::POSITION_SUPPER_ADMIN
        ]);
        Account::create([
            'username' => 'supperadmin',
            'password' => Hash::make('12345678'),
            'staff_id' => $staff->id,
            'status' => Account::STATUS_ACTIVE,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
}
