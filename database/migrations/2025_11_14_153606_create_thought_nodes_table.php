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
        Schema::create('thought_nodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_id')->constrained('thought_maps')->onDelete('cascade');
            $table->text('content');
            $table->float('position_x')->default(0);
            $table->float('position_y')->default(0);
            $table->string('color')->default('#6366f1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thought_nodes');
    }
};
