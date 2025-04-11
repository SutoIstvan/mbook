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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('memorial_id')->constrained('memorials')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->string('related_person')->nullable();
            $table->string('media')->nullable();
            $table->integer('order')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
