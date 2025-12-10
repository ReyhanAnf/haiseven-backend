<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CreativePrompt;

class TestPromptHistory extends Command
{
    protected $signature = 'test:prompt-history';
    protected $description = 'Test persistence for Prompt Architect History';

    public function handle()
    {
        $this->info('Testing Prompt History Persistence...');

        // 1. Create a record
        $this->info('1. Creating a test record...');
        try {
            $prompt = CreativePrompt::create([
                'prompt_text' => 'Test Prompt Content',
                'domain' => 'test_domain',
                'description' => 'Test Description',
                'settings' => ['key' => 'value'],
                'generated_prompt' => 'Generated content here',
                'recommended_tool' => 'Test Tool',
            ]);
            $this->info('   Record created with ID: ' . $prompt->id);
        } catch (\Exception $e) {
            $this->error('   Failed to create record: ' . $e->getMessage());
            return 1;
        }

        // 2. Retrieve the record
        $this->info('2. Retrieving record...');
        $retrieved = CreativePrompt::find($prompt->id);

        if ($retrieved) {
            $this->info('   Record found.');
            $this->line("   Domain: " . $retrieved->domain);
            $this->line("   Settings (JSON): " . json_encode($retrieved->settings));

            if ($retrieved->settings['key'] === 'value') {
               $this->info('   SUCCESS: JSON Settings cast correctly.');
            } else {
               $this->error('   FAILURE: Settings not cast correctly.');
            }

            // Cleanup
            $retrieved->delete();
            $this->info('   Test record deleted.');
        } else {
            $this->error('   FAILURE: Record not found.');
        }
    }
}
