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
            $table->unsignedBigInteger('department_id')->after('password');
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('designation_id')->after('department_id');
            $table->foreign('designation_id')->references('id')->on('designations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status',['0','1'])->default('1')->comment('0=inactive,1=active')->after('designation_id');
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
