<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a unified dashboard listing of student submissions across all courses taught by the lecturer.
     */
    public function index()
    {
        $lecturer = auth()->user()->lecturer;

        if (!$lecturer) {
            abort(403, 'Profil Dosen tidak ditemukan.');
        }

        // Get all courses owned by this lecturer
        $courses = Course::where('lecturer_id', $lecturer->id)->get();
        $courseIds = $courses->pluck('id')->toArray();

        // Get all assignments under these courses
        $assignmentIds = Assignment::whereIn('course_id', $courseIds)->pluck('id')->toArray();

        // Fetch paginated submissions with relationships
        $submissions = Submission::whereIn('assignment_id', $assignmentIds)
            ->with(['student', 'assignment.course', 'grade'])
            ->orderBy('submitted_at', 'desc')
            ->paginate(15);

        // Fetch statistics on all submissions for this lecturer
        $allSubmissions = Submission::whereIn('assignment_id', $assignmentIds)->get();
        $totalSubmissionsCount = $allSubmissions->count();
        $pendingGradingCount = $allSubmissions->where('status', 'submitted')->count();
        $gradedCount = $allSubmissions->where('status', 'graded')->count();

        return view('lecturer.grades.index', [
            'submissions' => $submissions,
            'courses' => $courses,
            'totalSubmissionsCount' => $totalSubmissionsCount,
            'pendingGradingCount' => $pendingGradingCount,
            'gradedCount' => $gradedCount,
        ]);
    }
}
