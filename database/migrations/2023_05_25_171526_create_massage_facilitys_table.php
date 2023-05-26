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
        Schema::create('massage_facilitys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ownerID');
            $table->foreign('ownerID')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('name'); 
            $table->string('description'); 
            $table->string('location'); 
            $table->string('imageURL'); 
            $table->string('phoneNumber'); 
            $table->string('emailAddress'); 
            $table->integer('capacity');
            $table->double('averageRating');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('massage_facilitys');
    }
};
