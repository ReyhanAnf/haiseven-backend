<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyFocus;
use App\Models\DailyFocusItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FocusController extends Controller
{
    /**
     * Store or update today's focus for the authenticated user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => ['nullable', 'array'],
            'items.*' => ['nullable'], // strings or objects
            'focus_1' => ['nullable', 'string', 'max:255'],
            'focus_2' => ['nullable', 'string', 'max:255'],
            'focus_3' => ['nullable', 'string', 'max:255'],
        ]);

        $userId = $request->user()->id;
        $today = Carbon::today()->toDateString();

        $day = DailyFocus::updateOrCreate(
            ['user_id' => $userId, 'date' => $today],
            ['user_id' => $userId, 'date' => $today]
        );

        // Determine items payload: prefer 'items' array; fallback to focus_1..3
        $itemsPayload = [];
        if (!empty($validated['items']) && is_array($validated['items'])) {
            $itemsPayload = array_values(array_filter(array_map(function ($item) {
                if (is_string($item)) {
                    return ['content' => trim($item), 'completed' => false];
                }
                if (is_array($item) && !empty($item['content'])) {
                    return [
                        'content' => trim((string)$item['content']),
                        'completed' => (bool)($item['completed'] ?? false),
                    ];
                }
                return null;
            }, $validated['items'])));
        } else {
            foreach (['focus_1', 'focus_2', 'focus_3'] as $idx => $key) {
                $val = $validated[$key] ?? null;
                if ($val !== null && $val !== '') {
                    $itemsPayload[] = ['content' => trim($val), 'completed' => false];
                }
            }
        }

        // Replace today's items with payload order
        DailyFocusItem::where('daily_focus_id', $day->id)->delete();
        foreach ($itemsPayload as $i => $item) {
            DailyFocusItem::create([
                'daily_focus_id' => $day->id,
                'content' => $item['content'],
                'completed' => $item['completed'] ?? false,
                'order' => $i,
            ]);
        }

        $day->load('items');
        return response()->json([
            'date' => $day->date->toDateString(),
            'items' => $day->items,
        ]);
    }

    /**
     * Get today's focus for the authenticated user.
     */
    public function getToday(Request $request)
    {
        $userId = $request->user()->id;
        $today = Carbon::today()->toDateString();

        $day = DailyFocus::with('items')
            ->where('user_id', $userId)
            ->where('date', $today)
            ->first();

        if (! $day) {
            return response()->json(null);
        }

        return response()->json([
            'date' => $day->date->toDateString(),
            'items' => $day->items,
        ]);
    }

    /**
     * Get recent history of focus days
     */
    public function history(Request $request)
    {
        $userId = $request->user()->id;
        $limit = (int) $request->query('limit', 14);
        $days = DailyFocus::withCount('items')
            ->where('user_id', $userId)
            ->orderByDesc('date')
            ->limit(max(1, min($limit, 60)))
            ->get(['id', 'date']);

        return response()->json($days);
    }
}
