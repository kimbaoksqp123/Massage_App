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
        Schema::table('create_requests', function (Blueprint $table) {
            $table->foreign('facilityID')
                ->references('id')
                ->on('massage_facilitys')
                ->onDelete('cascade');
            $table->foreign('userID')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('create_requests', function (Blueprint $table) {
            $table->dropForeign(['facilityID']);
            $table->dropForeign(['userID']);
        });
    }
};
