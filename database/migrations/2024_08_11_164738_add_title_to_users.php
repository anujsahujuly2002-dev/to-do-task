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
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('last_name')->after('name');
            $table->date('date_of_birth')->after('last_name');
            $table->string('profile_picture')->after('date_of_birth');
            $table->string('mobile_no')->after('profile_picture');
            $table->enum('status',['0','1'])->default('1')->comment('0=inactive,1=active')->after('profile_picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
