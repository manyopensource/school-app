<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function index() : JsonResponse
    {
        $students = Student::with(['klass'])->get();

        return response()->json($students);
    }

    public function show(Student $student)
    {
        $student->load(['klass', 'lessons']);

        return response()->json($student);
    }

    public function store(StoreStudentRequest $request)
    {
        $validated = $request->safe()->only(['email', 'klass_id', 'name']);
        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->safe()->only(['klass_id', 'name']);
        $student->update($validated);

        return response()->json($student, 200);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
