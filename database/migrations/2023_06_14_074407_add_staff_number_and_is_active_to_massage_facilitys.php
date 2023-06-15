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
        Schema::table('massage_facilitys', function (Blueprint $table) {
            $table->integer('staffNumber')->default(0);
            $table->boolean('isActive')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('massage_facilitys', function (Blueprint $table) {
            $table->dropColumn('staffNumber');
            $table->dropColumn('isActive');
        });
    }
};
