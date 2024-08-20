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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('alias');
            $table->unsignedBigInteger('facilities_id')->nullable();
            $table->foreign('facilities_id')->references('id')->on('facilities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('class',['0','1','2','3','4','5'])->default('0')->comment('0=none,1=1 Star,2=2 Star,3=3 Star,4=4 Star,5=5 star,')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->text('description')->nullable();
            $table->enum('home_page',['0','1'])->comment('0=no,1=yes')->default('0');
            $table->enum('release',['1','2','3','4'])->comment('1=Published,2=not published,3=Awating,4=Archived')->default('2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
