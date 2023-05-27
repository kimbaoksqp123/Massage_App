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
        Schema::create('image_librarys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facilityID');
            $table->foreign('facilityID')
                ->references('id')
                ->on('massage_facilitys')
                ->onDelete('cascade');
            $table->string('imageURL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_librarys');
    }
};
