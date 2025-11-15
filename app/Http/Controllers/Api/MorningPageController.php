<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MorningPage;
use Carbon\Carbon;

class MorningPageController extends Controller
{
    /**
     * Store a morning page entry (brain dump). If an entry exists for today, update it.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $today = Carbon::today()->toDateString();

        $entry = MorningPage::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'date' => $today,
            ],
            [
                'content' => $data['content'],
            ]
        );

        return response()->json([
            'message' => 'Morning page saved.',
            'entry' => $entry,
        ], 201);
    }

    /**
     * Get all morning pages for the authenticated user
     */
    public function index(Request $request)
    {
        $entries = MorningPage::where('user_id', $request->user()->id)
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($entries);
    }

    /**
     * Get a specific morning page by date
     */
    public function show(Request $request, $date)
    {
        $entry = MorningPage::where('user_id', $request->user()->id)
            ->where('date', $date)
            ->first();

        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        return response()->json($entry);
    }
}
