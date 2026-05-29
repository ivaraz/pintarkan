<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function show(Course $course, Assignment $assignment)
    {
        $student = auth()->user()->student;

        // Ensure the student is enrolled in this course
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda tidak terdaftar di mata kuliah ini.');
        }

        // Check if assignment belongs to course
        if ($assignment->course_id !== $course->id) {
            abort(404);
        }

        // Get submission
        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->with('grade')
            ->first();

        return view('student.assignments.show', compact('course', 'assignment', 'submission'));
    }

    public function submit(Request $request, Assignment $assignment)
    {
        $student = auth()->user()->student;

        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $assignment->course_id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda tidak terdaftar di mata kuliah ini.');
        }

        // Check deadline
        if (Carbon::parse($assignment->due_date)->isPast()) {
            return back()->with('error', 'Batas waktu pengumpulan tugas sudah terlewat.');
        }

        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,rar,doc,docx|max:5120', // Max 5MB
        ], [
            'file.required' => 'File tugas wajib diupload.',
            'file.mimes' => 'Format file harus berupa PDF, ZIP, RAR, atau Word.',
            'file.max' => 'Ukuran file maksimal adalah 5MB.',
        ]);

        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        // Check if already graded
        if ($submission && $submission->status === 'graded') {
            return back()->with('error', 'Tugas sudah dinilai dan tidak dapat diubah.');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $student->npm . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            
            // Store file in storage/app/public/submissions
            $path = $file->storeAs('submissions', $filename, 'public');

            Submission::updateOrCreate(
                [
                    'assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                ],
                [
                    'file' => $path,
                    'status' => 'submitted',
                    'submitted_at' => now(),
                ]
            );

            return back()->with('success', 'Tugas berhasil dikumpulkan.');
        }

        return back()->with('error', 'Gagal mengupload file.');
    }
}
