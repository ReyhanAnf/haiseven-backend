<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FocusController;
use App\Http\Controllers\Api\GratitudeController;
use App\Http\Controllers\Api\MorningPageController;
use App\Http\Controllers\Api\AffirmationController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\MuseController;
use App\Http\Controllers\Api\DecisionController;
use App\Http\Controllers\Api\ThoughtMapController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TelemetryController;
use App\Http\Controllers\Api\LanguageLabController;
use App\Http\Controllers\Api\LanguagePathController;
use App\Http\Controllers\Api\BlogPostController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Public: Positive Fortune Cookie
Route::get('/affirmation/random', [AffirmationController::class, 'getRandom']);
// Public: Morning Muse creative prompt
Route::get('/muse/random', [MuseController::class, 'getRandom']);
// Telemetry events (no auth required)
Route::post('/telemetry/upgrade-prompt', [TelemetryController::class, 'storeUpgradePromptEvent']);

// Blog posts (public)
Route::get('/blog-posts', [BlogPostController::class, 'index']);
Route::get('/blog-posts/{slug}', [BlogPostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Dashboard Statistics
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/activity', [DashboardController::class, 'recentActivity']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar']);

    // Daily Focus
    Route::post('/focus', [FocusController::class, 'store']);
    Route::get('/focus/today', [FocusController::class, 'getToday']);
    Route::get('/focus/history', [FocusController::class, 'history']);

    // Gratitude Jar
    Route::post('/gratitude', [GratitudeController::class, 'store']);
    Route::get('/gratitude', [GratitudeController::class, 'index']);

    // Morning Page (Brain Dump 3 menit)
    Route::post('/morning-page', [MorningPageController::class, 'store']);
    Route::get('/morning-page', [MorningPageController::class, 'index']);
    Route::get('/morning-page/{date}', [MorningPageController::class, 'show']);

    // Brain Warm-up Game Score
    Route::post('/brain-warmup/score', [GameController::class, 'storeScore']);
    Route::get('/brain-warmup/scores', [GameController::class, 'myTop']);
    Route::get('/brain-warmup/leaderboard', [GameController::class, 'leaderboard']);

    // Decision Maker
    Route::apiResource('/decisions', DecisionController::class);

    // Thought Canvas (Mind Mapper)
    Route::get('/thought-maps', [ThoughtMapController::class, 'index']);
    Route::post('/thought-maps', [ThoughtMapController::class, 'saveMap']);
    Route::get('/thought-maps/{map}', [ThoughtMapController::class, 'getMap']);
    Route::delete('/thought-maps/{map}', [ThoughtMapController::class, 'destroy']);
    Route::post('/thought-nodes/{node}/image', [ThoughtMapController::class, 'uploadNodeImage']);

    // Language Lab
    Route::get('/language-lab/vocab', [LanguageLabController::class, 'indexVocab']);
    Route::post('/language-lab/vocab', [LanguageLabController::class, 'storeVocab']);
    Route::delete('/language-lab/vocab/{entry}', [LanguageLabController::class, 'destroyVocab'])->whereNumber('entry');
    Route::get('/language-lab/usage', [LanguageLabController::class, 'usage']);
    Route::post('/language-lab/grammar-check', [LanguageLabController::class, 'grammarCheck']);
    Route::get('/language-lab/word-of-the-day', [LanguageLabController::class, 'wordOfTheDay']);

    // Language Path (Duolingo-style curriculum)
    Route::get('/language/path', [LanguagePathController::class, 'index']);
    Route::get('/language/lesson/{lesson}', [LanguagePathController::class, 'show']);
    Route::post('/language/lesson/complete', [LanguagePathController::class, 'complete']);
});
