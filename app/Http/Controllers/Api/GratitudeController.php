<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GratitudeEntry;

class GratitudeController extends Controller
{
    /**
     * Store a new gratitude entry for authenticated user.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $entry = GratitudeEntry::create([
            'user_id' => $request->user()->id,
            'content' => $data['content'],
        ]);

        return response()->json([
            'message' => 'Gratitude entry saved.',
            'entry' => $entry,
        ], 201);
    }

    /**
     * List all gratitude entries for authenticated user (latest first).
     */
    public function index(Request $request)
    {
        $entries = GratitudeEntry::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($entries);
    }
}
