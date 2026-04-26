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
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            $table->json('header')->nullable();
            $table->json('terminal')->nullable();
            $table->json('tags')->nullable();
            $table->json('profile')->nullable();
            $table->text('journey')->nullable();
            $table->json('education')->nullable();
            $table->json('training')->nullable();
            $table->json('experience')->nullable();
            $table->json('skills')->nullable();
            $table->json('philosophy')->nullable();
            $table->json('passions')->nullable();
            $table->json('footer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_settings');
    }
};
