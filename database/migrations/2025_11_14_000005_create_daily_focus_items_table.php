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
        Schema::create('daily_focus_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_focus_id')->constrained('daily_focuses')->cascadeOnDelete();
            $table->string('content');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_focus_items');
    }
};
