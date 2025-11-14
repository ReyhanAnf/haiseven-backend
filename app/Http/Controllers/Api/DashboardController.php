<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyFocus;
use App\Models\GratitudeEntry;
use App\Models\MorningPage;
use App\Models\GameScore;
use App\Models\Decision;
use App\Models\ThoughtMap;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats(Request $request)
    {
        $user = $request->user();
        $now = Carbon::now();
        $weekAgo = $now->copy()->subDays(7);

        // Total counts
        $totalFocus = DailyFocus::where('user_id', $user->id)->count();
        $totalGratitude = GratitudeEntry::where('user_id', $user->id)->count();
        $totalMorningPages = MorningPage::where('user_id', $user->id)->count();
        $totalDecisions = Decision::where('user_id', $user->id)->count();
        $totalCanvas = ThoughtMap::where('user_id', $user->id)->count();

        // Streaks
        $focusStreak = $this->calculateStreak(DailyFocus::class, $user->id, 'date');
        $gratitudeStreak = $this->calculateStreak(GratitudeEntry::class, $user->id, 'created_at');
        $morningPageStreak = $this->calculateStreak(MorningPage::class, $user->id, 'date');

        // Recent activity (last 7 days)
        $recentFocus = DailyFocus::where('user_id', $user->id)
            ->where('date', '>=', $weekAgo)
            ->count();
        $recentGratitude = GratitudeEntry::where('user_id', $user->id)
            ->where('created_at', '>=', $weekAgo)
            ->count();
        $recentMorningPages = MorningPage::where('user_id', $user->id)
            ->where('date', '>=', $weekAgo)
            ->count();

        // Best game score
        $bestGameScore = GameScore::where('user_id', $user->id)
            ->orderBy('score', 'desc')
            ->first();

        // Activity chart (last 30 days)
        $activityChart = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i)->format('Y-m-d');
            $activityChart[] = [
                'date' => $date,
                'focus' => DailyFocus::where('user_id', $user->id)
                    ->whereDate('date', $date)->exists() ? 1 : 0,
                'gratitude' => GratitudeEntry::where('user_id', $user->id)
                    ->whereDate('created_at', $date)->count(),
                'morning_page' => MorningPage::where('user_id', $user->id)
                    ->whereDate('date', $date)->exists() ? 1 : 0,
            ];
        }

        return response()->json([
            'totals' => [
                'focus' => $totalFocus,
                'gratitude' => $totalGratitude,
                'morning_pages' => $totalMorningPages,
                'decisions' => $totalDecisions,
                'canvas' => $totalCanvas,
            ],
            'streaks' => [
                'focus' => $focusStreak,
                'gratitude' => $gratitudeStreak,
                'morning_page' => $morningPageStreak,
            ],
            'recent' => [
                'focus' => $recentFocus,
                'gratitude' => $recentGratitude,
                'morning_pages' => $recentMorningPages,
            ],
            'best_game_score' => $bestGameScore ? [
                'score' => $bestGameScore->score,
                'game_type' => $bestGameScore->game_type,
                'date' => $bestGameScore->created_at->format('Y-m-d'),
            ] : null,
            'activity_chart' => $activityChart,
        ]);
    }

    private function calculateStreak($model, $userId, $dateColumn)
    {
        $streak = 0;
        $date = Carbon::today();

        while (true) {
            $exists = $model::where('user_id', $userId)
                ->whereDate($dateColumn, $date)
                ->exists();

            if (!$exists) {
                break;
            }

            $streak++;
            $date->subDay();
        }

        return $streak;
    }

    public function recentActivity(Request $request)
    {
        $user = $request->user();
        $activities = [];

        // Recent Focus
        $recentFocus = DailyFocus::where('user_id', $user->id)
            ->with('items')
            ->orderBy('date', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentFocus as $focus) {
            $activities[] = [
                'type' => 'focus',
                'title' => 'Daily Focus',
                'date' => $focus->date,
                'icon' => 'CheckCircle',
                'data' => $focus->items->pluck('text')->take(2)->toArray(),
            ];
        }

        // Recent Gratitude
        $recentGratitude = GratitudeEntry::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentGratitude as $gratitude) {
            $activities[] = [
                'type' => 'gratitude',
                'title' => 'Gratitude Entry',
                'date' => $gratitude->created_at->format('Y-m-d'),
                'icon' => 'HandHeart',
                'data' => substr($gratitude->text, 0, 60) . (strlen($gratitude->text) > 60 ? '...' : ''),
            ];
        }

        // Recent Morning Pages
        $recentMorning = MorningPage::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentMorning as $morning) {
            $activities[] = [
                'type' => 'morning_page',
                'title' => 'Morning Page',
                'date' => $morning->date,
                'icon' => 'Wind',
                'data' => substr($morning->content, 0, 60) . (strlen($morning->content) > 60 ? '...' : ''),
            ];
        }

        // Recent Canvas
        $recentCanvas = ThoughtMap::where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($recentCanvas as $canvas) {
            $activities[] = [
                'type' => 'canvas',
                'title' => $canvas->title,
                'date' => $canvas->updated_at->format('Y-m-d'),
                'icon' => 'GitBranch',
                'data' => 'Thought Canvas',
            ];
        }

        // Sort by date
        usort($activities, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return response()->json(array_slice($activities, 0, 10));
    }
}
