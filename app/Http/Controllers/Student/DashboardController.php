<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $student = $user->student;
        $enrollments = Enrollment::where('student_id', $student->id)
            ->with(['course.materials', 'course.assignments'])
            ->get();
        $courseIds = $enrollments->pluck('course_id');

        // Calculate progress for each enrollment
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $totalMaterials = $course->materials->count();
            $totalAssignments = $course->assignments->count();
            $totalItems = $totalMaterials + $totalAssignments;
            
            if ($totalItems === 0) {
                $enrollment->progress = 0;
            } else {
                $accessedMaterials = \Illuminate\Support\Facades\DB::table('material_student')
                    ->where('student_id', $student->id)
                    ->whereIn('material_id', $course->materials->pluck('id'))
                    ->count();
                    
                $submittedAssignments = Submission::where('student_id', $student->id)
                    ->whereIn('assignment_id', $course->assignments->pluck('id'))
                    ->count();
                    
                $enrollment->progress = round((($accessedMaterials + $submittedAssignments) / $totalItems) * 100);
            }
        }

        $assignments = Assignment::whereIn('course_id', $courseIds)->get();
        $submissions = Submission::where('student_id', $student->id)->with('grade')->get();

        $submittedAssignmentIds = $submissions->pluck('assignment_id')->toArray();
        $uncompletedAssignments = $assignments->whereNotIn('id', $submittedAssignmentIds)->sortBy('due_date');

        return view('student.dashboard', [
            'enrollments' => $enrollments,
            'enrollmentCount' => $enrollments->count(),
            'assignmentCount' => $assignments->count(),
            'completedAssignments' => $submissions->where('status', 'graded')->count(),
            'averageGrade' => $submissions->where('status', 'graded')->avg('grade.score') ?? 0,
            'assignments' => $uncompletedAssignments,
        ]);
    }
}
