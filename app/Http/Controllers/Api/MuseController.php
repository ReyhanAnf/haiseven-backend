<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreativePrompt;
use Illuminate\Http\JsonResponse;

class MuseController extends Controller
{
    /**
     * Return a random creative prompt (public endpoint).
     */
    public function getRandom(): JsonResponse
    {
        $prompt = CreativePrompt::inRandomOrder()->first();
        if (!$prompt) {
            return response()->json([
                'prompt_text' => 'Tulis tiga kalimat tentang cahaya pagi yang takut pada bayangan.',
            ]);
        }
        return response()->json($prompt);
    }
}
