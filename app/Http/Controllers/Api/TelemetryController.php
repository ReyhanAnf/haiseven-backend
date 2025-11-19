<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UpgradePromptEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelemetryController extends Controller
{
    public function storeUpgradePromptEvent(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'event' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'metadata' => ['nullable', 'array'],
        ]);

        $event = UpgradePromptEvent::create([
            'user_id' => $user?->id,
            'event' => $validated['event'],
            'location' => $validated['location'] ?? null,
            'metadata' => $validated['metadata'] ?? null,
        ]);

        if ($user === null) {
            Log::channel('daily')->info('Upgrade prompt event recorded without user', [
                'event_id' => $event->id,
                'event' => $event->event,
                'location' => $event->location,
            ]);
        }

        return response()->json($event, 201);
    }
}
