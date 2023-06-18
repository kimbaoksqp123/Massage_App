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
            $table->double('averageRating')->default(0)->change();
            $table->string('imageURL')->default('img\img_user\avatar_01.jpg')->change();
            $table->integer('capacity')->default(100)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('massage_facilitys', function (Blueprint $table) {
            //
        });
    }
};
