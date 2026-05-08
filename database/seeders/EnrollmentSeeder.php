<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {
            $randomCourses = $courses->random(3);

            foreach ($randomCourses as $course) {
                Enrollment::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'status' => 'enrolled',
                    'enrolled_at' => now()
                ]);
            }
        }
    }
}
