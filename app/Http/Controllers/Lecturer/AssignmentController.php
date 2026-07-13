<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use App\Models\Grade;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('lecturer.assignments.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'file' => 'nullable|file|max:10240',
            'allow_late' => 'nullable|boolean',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request
                ->file('file')
                ->store('assignments', 'public');
        }

        Assignment::create([
            'course_id' => $course->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'],
            'max_score' => 100,
            'file' => $filePath,
            'allow_late' => $request->boolean('allow_late'),
        ]);

        return redirect()
            ->route('lecturer.courses.show', $course)
            ->with([
                'alert-type' => 'success',
                'message' => 'Tugas berhasil ditambahkan.',
            ]);
    }

    /**
     * Display the specified assignment.
     */
    public function show(Course $course, Assignment $assignment)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($assignment->course_id !== $course->id) {
            abort(404);
        }

        // Get enrollments and eager load students
        $enrollments = $course->enrollments()->with('student')->get();

        // Get submissions with grades, keyed by student_id
        $submissions = $assignment->submissions()->with('grade')->get()->keyBy('student_id');

        return view('lecturer.assignments.show', compact('course', 'assignment', 'enrollments', 'submissions'));
    }

    /**
     * Grade a student submission.
     */
    public function grade(Request $request, Assignment $assignment, Submission $submission)
    {
        if ($assignment->course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($submission->assignment_id !== $assignment->id) {
            abort(404);
        }

        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0', 'max:' . $assignment->max_score],
            'note' => ['nullable', 'string'],
        ], [
            'score.required' => 'Nilai harus diisi',
            'score.integer' => 'Nilai harus berupa angka',
            'score.min' => 'Nilai minimal 0',
            'score.max' => 'Nilai maksimal adalah ' . $assignment->max_score,
        ]);

        try {
            // Find or create grade record
            $submission->grade()->updateOrCreate(
                ['submission_id' => $submission->id],
                [
                    'score' => $validated['score'],
                    'note' => $validated['note'] ?? null,
                ]
            );

            // Update submission status to graded
            $submission->update(['status' => 'graded']);

            return back()->with([
                'alert-type' => 'success',
                'message' => 'Nilai berhasil disimpan.',
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
