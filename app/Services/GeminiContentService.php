<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiContentService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function generateContent(string $title, string $category): array
    {
        // ... (keep existing implementation but maybe refactor to use generateText if possible,
        // strictly speaking for this task I just need to add the new method first to be safe)
        if (empty($this->apiKey)) {
            throw new \Exception('Gemini API Key is missing.');
        }

        $prompt = "Act as a viral science content strategist. For the topic '{$title}' in category '{$category}', provide:
        1. 3 Viral Hooks/Clickbait titles.
        2. A list of visual stock footage ideas or AI image prompts.
        3. A caption with hashtags suitable for TikTok/Reels.

        Return the response strictly in JSON format with the following structure:
        {
            \"hooks\": [\"hook1\", \"hook2\", \"hook3\"],
            \"visual_prompts\": \"...\",
            \"captions\": \"...\"
        }";

        $response = $this->callGemini($prompt, true);
        $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

        // Clean markdown code blocks if present
        $text = preg_replace('/^```json\s*|\s*```$/', '', trim($text));

        return json_decode($text, true) ?? [];
    }

    public function generateText(string $prompt): string
    {
        if (empty($this->apiKey)) {
            throw new \Exception('Gemini API Key is missing.');
        }

        $response = $this->callGemini($prompt, false);
        return $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }

    protected function callGemini(string $prompt, bool $jsonMode = false): array
    {
        // Use configured model or default to gemini-1.5-flash-latest
        $model = env('GEMINI_MODEL', 'gemini-1.5-flash-latest');
        $url = "{$this->baseUrl}{$model}:generateContent?key={$this->apiKey}";

        $config = [];
        if ($jsonMode) {
             $config['responseMimeType'] = 'application/json';
        }

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
        ];

        if (!empty($config)) {
            $payload['generationConfig'] = $config;
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                throw new \Exception('Failed to generate content from Gemini: ' . $response->json('error.message'));
            }

            return $response->json();

        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }
}
