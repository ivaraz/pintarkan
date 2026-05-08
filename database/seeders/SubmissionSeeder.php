<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Submission;
use App\Models\Assignment;
use App\Models\Enrollment;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = Assignment::all();

        foreach ($assignments as $assignment) {
            $enrollments = Enrollment::where('course_id', $assignment->course_id)->get();

            foreach ($enrollments as $enroll) {
                Submission::create([
                    'assignment_id' => $assignment->id,
                    'student_id' => $enroll->student_id,
                    'file' => 'submissions/file.pdf',
                    'status' => 'submitted'
                ]);
            }
        }
    }
}
