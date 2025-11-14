<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Decision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Decision::where('user_id', Auth::id())->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pros' => 'present|array',
            'cons' => 'present|array',
            'pros.*' => 'nullable|string|max:255',
            'cons.*' => 'nullable|string|max:255',
        ]);

        $decision = Decision::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'pros' => array_filter($validated['pros'] ?? []),
            'cons' => array_filter($validated['cons'] ?? []),
        ]);

        return response()->json($decision, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Decision $decision)
    {
        if ($decision->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $decision;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Decision $decision)
    {
        if ($decision->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'pros' => 'sometimes|present|array',
            'cons' => 'sometimes|present|array',
            'pros.*' => 'nullable|string|max:255',
            'cons.*' => 'nullable|string|max:255',
        ]);

        if (isset($validated['pros'])) {
            $validated['pros'] = array_filter($validated['pros']);
        }
        if (isset($validated['cons'])) {
            $validated['cons'] = array_filter($validated['cons']);
        }

        $decision->update($validated);

        return response()->json($decision);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decision $decision)
    {
        if ($decision->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $decision->delete();

        return response()->json(null, 204);
    }
}
