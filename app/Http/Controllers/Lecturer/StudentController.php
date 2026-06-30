<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Submission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Get the lecturer, aborting if not found.
     */
    private function getLecturer()
    {
        $lecturer = auth()->user()->lecturer;
        if (!$lecturer) {
            abort(403, 'Profil Dosen tidak ditemukan.');
        }
        return $lecturer;
    }

    /**
     * Build per-course grade data for a student within lecturer's courses.
     */
    private function buildStudentCourseData(Student $student, array $courseIds): array
    {
        $enrollments = Enrollment::where('student_id', $student->id)
            ->whereIn('course_id', $courseIds)
            ->with('course.assignments.submissions.grade')
            ->get();

        $coursesData = [];
        $grandTotalScore = 0;
        $grandTotalMax   = 0;

        foreach ($enrollments as $enrollment) {
            $course      = $enrollment->course;
            $assignments = $course->assignments;

            $assignmentRows = [];
            $courseTotalScore = 0;
            $courseTotalMax   = 0;

            foreach ($assignments as $assignment) {
                $submission = $assignment->submissions
                    ->where('student_id', $student->id)
                    ->first();

                $score    = null;
                $status   = 'Belum Mengumpulkan';
                $isGraded = false;

                if ($submission) {
                    $status = 'Sudah Dikumpulkan';
                    if ($submission->status === 'graded' && $submission->grade) {
                        $score    = $submission->grade->score;
                        $isGraded = true;
                        $status   = 'Sudah Dinilai';
                        $courseTotalScore += $score;
                    }
                }

                $courseTotalMax += $assignment->max_score ?? 0;

                $assignmentRows[] = [
                    'assignment' => $assignment,
                    'submission' => $submission,
                    'score'      => $score,
                    'status'     => $status,
                    'is_graded'  => $isGraded,
                ];
            }

            $courseAverage = ($courseTotalMax > 0)
                ? round(($courseTotalScore / $courseTotalMax) * 100, 1)
                : null;

            $grandTotalScore += $courseTotalScore;
            $grandTotalMax   += $courseTotalMax;

            $coursesData[] = [
                'course'         => $course,
                'enrollment'     => $enrollment,
                'assignments'    => $assignmentRows,
                'total_score'    => $courseTotalScore,
                'total_max'      => $courseTotalMax,
                'course_average' => $courseAverage,
            ];
        }

        $overallAverage = ($grandTotalMax > 0)
            ? round(($grandTotalScore / $grandTotalMax) * 100, 1)
            : null;

        return [
            'courses_data'    => $coursesData,
            'overall_average' => $overallAverage,
            'grand_total_score' => $grandTotalScore,
            'grand_total_max'   => $grandTotalMax,
        ];
    }

    /**
     * Display a listing of all unique students enrolled in the lecturer's courses.
     */
    public function index()
    {
        $lecturer = $this->getLecturer();

        // Get all courses owned by this lecturer
        $courses   = Course::where('lecturer_id', $lecturer->id)->get();
        $courseIds = $courses->pluck('id')->toArray();

        // Get all enrollments for these courses, with student & course details
        $enrollments = Enrollment::whereIn('course_id', $courseIds)
            ->with(['student.user', 'course'])
            ->get();

        // Group enrollments by unique student
        $studentsData         = [];
        $totalEnrollmentsCount = $enrollments->count();

        foreach ($enrollments as $enrollment) {
            $student = $enrollment->student;
            if (!$student) continue;

            if (!isset($studentsData[$student->id])) {
                $studentsData[$student->id] = [
                    'student' => $student,
                    'courses' => [],
                ];
            }
            $studentsData[$student->id]['courses'][] = $enrollment->course;
        }

        return view('lecturer.students.index', [
            'studentsData'          => $studentsData,
            'uniqueStudentsCount'   => count($studentsData),
            'totalEnrollmentsCount' => $totalEnrollmentsCount,
            'coursesCount'          => $courses->count(),
        ]);
    }

    /**
     * Show detail rekap nilai & matakuliah for a specific student.
     */
    public function show(Student $student)
    {
        $lecturer  = $this->getLecturer();
        $courseIds = Course::where('lecturer_id', $lecturer->id)->pluck('id')->toArray();

        // Make sure student is in at least one of lecturer's courses
        $enrolled = Enrollment::where('student_id', $student->id)
            ->whereIn('course_id', $courseIds)
            ->exists();

        if (!$enrolled) {
            abort(403, 'Mahasiswa ini bukan binaan Anda.');
        }

        $data = $this->buildStudentCourseData($student, $courseIds);

        return view('lecturer.students.show', array_merge(['student' => $student], $data));
    }

    /**
     * Export rekap nilai mahasiswa ke PDF.
     */
    public function exportPdf(Student $student)
    {
        $lecturer  = $this->getLecturer();
        $courseIds = Course::where('lecturer_id', $lecturer->id)->pluck('id')->toArray();

        $enrolled = Enrollment::where('student_id', $student->id)
            ->whereIn('course_id', $courseIds)
            ->exists();

        if (!$enrolled) {
            abort(403, 'Mahasiswa ini bukan binaan Anda.');
        }

        $data = $this->buildStudentCourseData($student, $courseIds);

        $pdf = Pdf::loadView('lecturer.students.pdf', array_merge(
            ['student' => $student, 'lecturer' => auth()->user()->lecturer],
            $data
        ))->setPaper('a4', 'portrait');

        $filename = 'rekap-nilai-' . str_replace(' ', '-', strtolower($student->name)) . '.pdf';

        return $pdf->download($filename);
    }
}
