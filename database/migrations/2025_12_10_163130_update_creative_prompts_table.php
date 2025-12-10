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
        Schema::table('creative_prompts', function (Blueprint $table) {
            $table->string('domain')->default('image');
            $table->text('description')->nullable();
            $table->json('settings')->nullable();
            $table->text('generated_prompt')->nullable();
            $table->string('recommended_tool')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('creative_prompts', function (Blueprint $table) {
            $table->dropColumn(['domain', 'description', 'settings', 'generated_prompt', 'recommended_tool']);
        });
    }
};
