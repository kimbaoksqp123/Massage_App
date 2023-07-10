<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('username');
            $table->string('password');
            $table->string('email');
            // $table->timestamp('email_verified_at')->nullable();

            // $table->rememberToken();
            $table->string('phoneNumber');
            $table->string('fullname');
            $table->integer('age');
            $table->string('avatarImageUrl')->default('img/img_user/avatar_01.jpg');
            $table->boolean('gender');
            $table->integer('userType');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
