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
        Schema::table('to_do_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->after('category_id');
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('to_do_lists', function (Blueprint $table) {
            //
        });
    }
};
