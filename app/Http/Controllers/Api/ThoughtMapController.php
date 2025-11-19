<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThoughtMap;
use App\Models\ThoughtNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ThoughtMapController extends Controller
{
    /**
     * Display a listing of thought maps for the authenticated user.
     */
    public function index()
    {
        $maps = ThoughtMap::where('user_id', Auth::id())
            ->withCount('nodes')
            ->latest()
            ->get();

        return response()->json($maps);
    }

    /**
     * Save or update a thought map with its nodes.
     */
    public function saveMap(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer|exists:thought_maps,id',
            'title' => 'required|string|max:255',
            'nodes' => 'present|array',
            'nodes.*.id' => 'nullable|integer',
            'nodes.*.content' => 'required|string',
            'nodes.*.position_x' => 'required|numeric',
            'nodes.*.position_y' => 'required|numeric',
            'nodes.*.color' => 'nullable|string|max:20',
            'nodes.*.connections' => 'nullable|array',
            'nodes.*.connections.*' => 'integer',
            'nodes.*.image_url' => 'nullable|string|max:2048',
        ]);

        $user = Auth::user();
        $user?->refreshSubscriptionStatus();

        $requiresPro = collect($validated['nodes'] ?? [])->contains(function ($node) {
            $hasConnections = !empty($node['connections']) && is_array($node['connections']);
            $hasImage = !empty($node['image_url']);

            return $hasConnections || $hasImage;
        });

        if ($requiresPro && (! $user || ! $user->is_pro)) {
            return response()->json([
                'message' => 'Thought Canvas PRO diperlukan untuk menyimpan koneksi atau image nodes.',
            ], 402);
        }

        DB::beginTransaction();
        try {
            // Create or update the map
            if (!empty($validated['id'])) {
                $map = ThoughtMap::findOrFail($validated['id']);

                // Check ownership
                if ($map->user_id !== Auth::id()) {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }

                $map->update(['title' => $validated['title']]);
            } else {
                $map = ThoughtMap::create([
                    'user_id' => Auth::id(),
                    'title' => $validated['title'],
                ]);
            }

            // Delete existing nodes and recreate (simple approach)
            $map->nodes()->delete();

            // Create new nodes
            foreach ($validated['nodes'] as $nodeData) {
                ThoughtNode::create([
                    'map_id' => $map->id,
                    'content' => $nodeData['content'],
                    'position_x' => $nodeData['position_x'],
                    'position_y' => $nodeData['position_y'],
                    'color' => $nodeData['color'] ?? '#6366f1',
                    'connections' => $nodeData['connections'] ?? [],
                    'image_url' => $nodeData['image_url'] ?? null,
                ]);
            }

            DB::commit();

            // Return the map with its nodes
            return response()->json($map->load(['nodes' => fn ($query) => $query->orderBy('id')]));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to save map', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get a specific thought map with all its nodes.
     */
    public function getMap(ThoughtMap $map)
    {
        // Check ownership
        if ($map->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

    $user = Auth::user();
    $user?->refreshSubscriptionStatus();

    return response()->json($map->load(['nodes' => fn ($query) => $query->orderBy('id')]));
    }

    /**
     * Delete a thought map.
     */
    public function destroy(ThoughtMap $map)
    {
        // Check ownership
        if ($map->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $map->delete();

        return response()->json(null, 204);
    }

    /**
     * Upload an image asset for a thought node (PRO only).
     */
    public function uploadNodeImage(Request $request, ThoughtMap $map)
    {
        if ($map->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = $request->user();
        $user?->refreshSubscriptionStatus();

        if (! $user || ! $user->is_pro) {
            return response()->json([
                'message' => 'Image nodes tersedia untuk pelanggan haiseven PRO.',
            ], 402);
        }

        $validated = $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $path = $validated['image']->store('thought-maps/'.$map->id, 'public');
        $url = Storage::disk('public')->url($path);

        return response()->json([
            'image_url' => $url,
            'path' => $path,
        ], 201);
    }
}
