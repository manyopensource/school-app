<?php

namespace Database\Seeders;

use App\Models\Klass;
use App\Models\Lesson;
use App\Models\Student;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Klass::factory()
            ->count(25)
            ->create()
            ->each(function ($klass) {
                $lessons = Lesson::factory()
                    ->count(100)
                    ->create();
                $lessonsTaken = $lessons
                    ->shuffle()
                    ->take(rand(40, 75));

                $students = Student::factory()
                    ->count(20)
                    ->create()
                    ->shuffle()
                    ->each(function ($student) use ($lessonsTaken) {
                        $student->lessons()->attach($lessonsTaken);
                    });

                $klass->students()->saveMany($students);
        
                $lessonPivotData = [];
                foreach ($lessons as $index => $lesson) {
                    $lessonPivotData[$lesson->id] = ['order' => $index + 1];
                }

                $klass->lessons()->attach($lessonPivotData);
            });
    }
}
