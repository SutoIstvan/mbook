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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('image_date')->nullable();
            $table->string('image_description')->nullable();
            $table->string('memorial_id')->nullable();
            $table->timestamps();
            $table->foreign('memorial_id')
                  ->references('id')
                  ->on('memorials')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
