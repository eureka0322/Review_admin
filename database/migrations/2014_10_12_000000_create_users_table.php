<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id')->default(2)->comment('1=Admin, 2=TA/TP');
            $table->tinyInteger('status')->default(1);

            $table->tinyInteger('removed')->default(0);
            $table->string('removed_reason');
            $table->string('gender')->default("1");
            $table->date('birth');
            $table->integer('prefecture_id');
            $table->integer('city_id');
            $table->tinyInteger('is_admin')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
