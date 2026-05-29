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
            // Enroll students in a random number of courses between 3 and 5
            $randomCoursesCount = rand(3, 5);
            $randomCourses = $courses->random($randomCoursesCount);

            foreach ($randomCourses as $course) {
                Enrollment::firstOrCreate([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'status' => 'active',
                    'enrolled_at' => now()->subDays(rand(10, 30))
                ]);
            }
        }
    }
}
