<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;

class LessonController extends Controller
{
    public function index() : JsonResponse
    {
        $lessons = Lesson::all();

        return response()->json($lessons);
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['klasses', 'students']);

        return response()->json($lesson);
    }

    public function store(StoreLessonRequest $request)
    {
        $validated = $request->safe()->only(['subject', 'description']);
        $lesson = Lesson::create($validated);

        return response()->json($lesson, 201);
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $validated = $request->safe()->only(['subject', 'description']);
        $lesson->update($validated);

        return response()->json($lesson, 200);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json(null, 204);
    }
}
