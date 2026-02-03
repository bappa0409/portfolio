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
        Schema::create('home_page_settings', function (Blueprint $table) {
            $table->id();
            $table->json('sections_meta')->nullable();
            $table->json('hero')->nullable();
            $table->json('services')->nullable();
            $table->json('cta_top')->nullable();
            $table->json('why_choose_me')->nullable();
            $table->json('process')->nullable();
            $table->json('tech_stack')->nullable();
            $table->json('stats')->nullable();
            $table->json('cta_bottom')->nullable();
            $table->json('testimonials')->nullable();
            $table->json('faq')->nullable();
            $table->json('featured_projects')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_settings');
    }
};
