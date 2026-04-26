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
        Schema::create('github_settings', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->text('token')->nullable();
            $table->string('repo_visibility')->default('all'); // all / public / private
            $table->boolean('sync_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('github_settings');
    }
};
