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
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status')->default('idea'); // idea, scripting, dubbing, editing, ready_to_upload, posted
            $table->boolean('platform_tiktok')->default(false);
            $table->boolean('platform_reels')->default(false);
            $table->boolean('platform_shorts')->default(false);
            $table->string('google_drive_link')->nullable();
            $table->longText('script_body')->nullable();
            $table->json('generated_hooks')->nullable();
            $table->longText('generated_visual_prompts')->nullable();
            $table->longText('generated_captions')->nullable();

            $table->foreignId('batch_id')->nullable()->constrained('content_batches')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('content_categories')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};
