<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlassRequest;
use App\Http\Requests\SyncLessonsKlassRequest;
use App\Http\Requests\UpdateKlassRequest;
use App\Models\Klass;
use Illuminate\Http\JsonResponse;

class KlassController extends Controller
{
    public function index() : JsonResponse
    {
        return response()->json(Klass::all());
    }

    public function show(Klass $klass)
    {
        $klass->load(['students', 'students.klass']);

        return response()->json($klass);
    }

    public function getLessons(Klass $klass)
    {
        return response()->json($klass->lessons);
    }

    public function syncLessons(SyncLessonsKlassRequest $request, Klass $klass)
    {
        $lessons = $request->validated('lessons');
        $klass->lessons()->sync($lessons);

        return response()->json(['message' => 'Lessons synced successfully'], 200);
    }

    public function store(StoreKlassRequest $request)
    {
        $validated = $request->safe()->only(['name']);
        $klass = Klass::create($validated);

        return response()->json($klass, 201);
    }

    public function update(UpdateKlassRequest $request, Klass $klass)
    {
        $validated = $request->safe()->only(['name']);
        $klass->update($validated);

        return response()->json($klass, 200);
    }

    public function destroy(Klass $klass)
    {
        $klass->delete();
        
        return response()->json(null, 204);
    }
}
