<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LanguageLesson;
use App\Models\LanguageModule;
use App\Models\LessonProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class LanguagePathController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $modules = LanguageModule::with(['lessons'])->orderBy('order')->get();
        $completedLessonIds = LessonProgress::where('user_id', $user->id)->pluck('lesson_id')->all();
        $completedSet = array_flip($completedLessonIds);

        $canAttemptNext = true;
        $responseModules = [];
        $totalLessons = 0;
        $completedLessons = 0;

        foreach ($modules as $module) {
            $lessonsData = [];
            $moduleLessons = $module->lessons->sortBy('order')->values();
            $moduleTotal = 0;
            $moduleCompletedCount = 0;

            foreach ($moduleLessons as $lesson) {
                $moduleTotal++;
                $totalLessons++;
                $isCompleted = array_key_exists($lesson->id, $completedSet);
                if ($isCompleted) {
                    $completedLessons++;
                    $moduleCompletedCount++;
                }

                $isUnlocked = $canAttemptNext || $isCompleted;

                $lessonsData[] = [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'order' => $lesson->order,
                    'is_completed' => $isCompleted,
                    'is_unlocked' => $isUnlocked,
                ];

                $canAttemptNext = $isCompleted;
            }

            $responseModules[] = [
                'id' => $module->id,
                'title' => $module->title,
                'description' => $module->description,
                'order' => $module->order,
                'lessons' => $lessonsData,
                'lessons_count' => $moduleTotal,
                'completed_lessons_count' => $moduleCompletedCount,
                'is_completed' => $moduleTotal > 0 && $moduleTotal === $moduleCompletedCount,
            ];
        }

        return response()->json([
            'modules' => $responseModules,
            'summary' => [
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
            ],
        ]);
    }

    public function show(LanguageLesson $lesson): JsonResponse
    {
        $lesson->loadMissing(['module', 'questions']);

        return response()->json([
            'lesson' => [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'module' => $lesson->module ? [
                    'id' => $lesson->module->id,
                    'title' => $lesson->module->title,
                ] : null,
            ],
            'questions' => $lesson->questions->map(fn ($question) => [
                'id' => $question->id,
                'question_type' => $question->question_type,
                'question' => $question->question,
                'options' => $question->options ?? [],
                'correct_answer' => $question->correct_answer,
            ])->values(),
        ]);
    }

    public function complete(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lesson_id' => ['required', 'integer', Rule::exists('language_lessons', 'id')],
        ]);

        $user = $request->user();
        $lessonId = $data['lesson_id'];

        $lesson = LanguageLesson::findOrFail($lessonId);

        $alreadyCompleted = LessonProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->exists();

        LessonProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed_at' => Carbon::now(),
            ]
        );

        $totalCompleted = LessonProgress::where('user_id', $user->id)->count();

        return response()->json([
            'message' => 'Lesson marked as completed.',
            'lesson_id' => $lesson->id,
            'xp_awarded' => $alreadyCompleted ? 0 : 15,
            'already_completed' => $alreadyCompleted,
            'completed_lessons_total' => $totalCompleted,
        ]);
    }
}
