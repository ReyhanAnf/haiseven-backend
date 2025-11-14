<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\GameScore;

class GameController extends Controller
{
    /**
     * Store a new game score for authenticated user.
     */
    public function storeScore(Request $request): JsonResponse
    {
        $data = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
            'game_type' => ['required', 'string', 'max:32'],
        ]);

        $score = GameScore::create([
            'user_id' => $request->user()->id,
            'score' => $data['score'],
            'game_type' => $data['game_type'],
        ]);

        return response()->json([
            'message' => 'Score saved',
            'score' => $score,
        ], 201);
    }

    /**
     * Get top 10 scores for the authenticated user.
     */
    public function myTop(Request $request): JsonResponse
    {
        $gameType = $request->query('game_type', 'Math');
        $scores = GameScore::where('user_id', $request->user()->id)
            ->where('game_type', $gameType)
            ->orderByDesc('score')
            ->limit(10)
            ->get();

        return response()->json($scores);
    }

    /**
     * Get global leaderboard top 10 scores (includes user name).
     */
    public function leaderboard(Request $request): JsonResponse
    {
        $gameType = $request->query('game_type', 'Math');
        $scores = GameScore::with(['user:id,name'])
            ->where('game_type', $gameType)
            ->orderByDesc('score')
            ->limit(10)
            ->get();

        return response()->json($scores);
    }
}
