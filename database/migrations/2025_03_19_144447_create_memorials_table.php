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
        Schema::create('memorials', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable()->unique();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->date('death_date')->nullable();
            $table->string('photo')->nullable();
            $table->text('photos')->nullable();
            $table->text('video')->nullable();
            $table->text('biography')->nullable();
            $table->text('history')->nullable();
            $table->text('story')->nullable();
            $table->text('testimonials')->nullable();
            $table->text('comments')->nullable();
            $table->text('gift')->nullable();
            $table->string('qr_code')->unique();
            $table->string('virtual_code')->nullable()->unique();
            $table->foreignId('admin_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memorials');
    }
};
