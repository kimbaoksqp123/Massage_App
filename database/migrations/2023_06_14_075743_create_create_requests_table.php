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
        Schema::create('create_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facilityID');
            $table->unsignedBigInteger('userID');
            $table->tinyInteger('requestStatus');
            $table->date('createdDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_requests');
    }
};
