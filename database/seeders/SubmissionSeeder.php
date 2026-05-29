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
            $dueDate = \Carbon\Carbon::parse($assignment->due_date);
            $isPast = $dueDate->isPast();

            foreach ($enrollments as $enroll) {
                // If past assignment: 90% submission rate.
                // If future assignment: 30% early submission rate.
                $submitChance = $isPast ? 90 : 30;

                if (rand(1, 100) <= $submitChance) {
                    $student = $enroll->student;
                    
                    // Create realistic submitted date
                    if ($isPast) {
                        // Submitted between 1 and 5 days before due date
                        $submittedAt = $dueDate->copy()->subDays(rand(1, 5))->subHours(rand(1, 12));
                    } else {
                        // Submitted in the last 2 days
                        $submittedAt = now()->subDays(rand(0, 1))->subHours(rand(1, 12));
                    }

                    Submission::create([
                        'assignment_id' => $assignment->id,
                        'student_id' => $enroll->student_id,
                        'file' => 'submissions/tugas_' . strtolower(str_replace(' ', '_', substr($assignment->title, 0, 15))) . '_' . ($student ? $student->npm : $enroll->student_id) . '.pdf',
                        'status' => 'submitted', // Will be updated to 'graded' in GradeSeeder if graded
                        'submitted_at' => $submittedAt,
                    ]);
                }
            }
        }
    }
}
