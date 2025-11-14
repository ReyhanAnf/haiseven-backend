<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Affirmation;
use Illuminate\Http\JsonResponse;

class AffirmationController extends Controller
{
    /**
     * Return a random affirmation (public endpoint).
     */
    public function getRandom(): JsonResponse
    {
        $affirmation = Affirmation::inRandomOrder()->first();

        if (!$affirmation) {
            return response()->json([
                'text' => 'Hari ini aku memilih hal baik dan bergerak maju.',
            ]);
        }

        return response()->json($affirmation);
    }
}
