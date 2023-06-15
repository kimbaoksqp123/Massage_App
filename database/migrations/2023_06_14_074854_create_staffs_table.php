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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facilityID');
            $table->string('name');
            $table->date('dob');
            $table->boolean('gender');
            $table->tinyInteger('jlpt');
            $table->string('certificateImage', 200);
            $table->string('image', 200);
            $table->string('hometown', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
