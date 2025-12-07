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
        if (empty($this->apiKey)) {
            throw new \Exception('Gemini API Key is missing.');
        }

        // Use configured model or default to gemini-1.5-flash-latest or gemini-pro
        $model = env('GEMINI_MODEL', 'gemini-1.5-flash-latest');

        $url = "{$this->baseUrl}{$model}:generateContent?key={$this->apiKey}";

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

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'responseMimeType' => 'application/json',
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                throw new \Exception('Failed to generate content from Gemini: ' . $response->json('error.message'));
            }

            $data = $response->json();
            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

            return json_decode($text, true) ?? [];

        } catch (\Exception $e) {
            Log::error('Gemini Service Exception: ' . $e->getMessage());
            throw $e;
        }
    }
}
