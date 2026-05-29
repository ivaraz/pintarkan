<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of courses for the authenticated lecturer.
     */
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        $courses = Course::where('lecturer_id', $lecturer->id)
            ->with(['lecturers', 'enrollments', 'materials', 'assignments'])
            ->paginate(15);

        return view('lecturer.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('lecturer.courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ], [
            'title.required' => 'Judul matkul harus diisi',
            'title.max' => 'Judul matkul maksimal 255 karakter',
        ]);

        try {
            $lecturer = auth()->user()->lecturer;
            $validated['lecturer_id'] = $lecturer->id;

            Course::create($validated);
            $notif = array('message' => 'Matkul berhasil ditambahkan', 'alert-type' => 'success');
            return redirect()->route('lecturer.courses.index')->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $course->load([
            'lecturers',
            'enrollments.student',
            'assignments',
            'materials',
        ]);

        return view('lecturer.courses.show', [
            'course' => $course,
            'enrolledStudents' => $course->enrollments,
        ]);
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('lecturer.courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        try {
            $course->update($validated);
            $notif = array('message' => 'Matkul berhasil diperbarui', 'alert-type' => 'success');
            return redirect()->route('lecturer.courses.show', $course)->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $course->delete();
            $notif = array('message' => 'Matkul berhasil dihapus', 'alert-type' => 'success');
            return redirect()->route('lecturer.courses.index')->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show form for adding students to a course.
     */
    public function students(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $course->load('enrollments');
        $enrolledStudentIds = $course->enrollments()->pluck('student_id')->toArray();
        $students = Student::whereNotIn('id', $enrolledStudentIds)->get();
        return view('lecturer.courses.add-students', compact('course', 'students'));
    }

    /**
     * Store student enrollment to a course.
     */
    public function storeEnrollment(Request $request, Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'student_ids' => ['required', 'array', 'min:1'],
            'student_ids.*' => ['exists:students,id'],
        ], [
            'student_ids.required' => 'Pilih minimal satu mahasiswa',
            'student_ids.*.exists' => 'Data mahasiswa tidak valid',
        ]);

        try {
            foreach ($validated['student_ids'] as $studentId) {
                Enrollment::firstOrCreate(
                    ['student_id' => $studentId, 'course_id' => $course->id],
                    ['status' => 'active', 'enrolled_at' => now()]
                );
            }
            $notif = array('message' => 'Mahasiswa berhasil ditambahkan ke matkul', 'alert-type' => 'success');
            return redirect()->route('lecturer.courses.show', $course)->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove student enrollment from a course.
     */
    public function removeStudent(Course $course, Enrollment $enrollment)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        try {
            if ($enrollment->course_id !== $course->id) {
                return back()->with('error', 'Data tidak valid');
            }
            $enrollment->delete();
            $notif = array('message' => 'Mahasiswa berhasil dihapus dari matkul', 'alert-type' => 'success');
            return back()->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display a recap of student grades for all assignments in the course.
     */
    public function gradesRecap(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        $course->load(['assignments', 'enrollments.student']);
        $assignments = $course->assignments;
        $enrollments = $course->enrollments;

        // Fetch all submissions with grades for the assignments of this course
        $assignmentIds = $assignments->pluck('id')->toArray();
        $submissions = \App\Models\Submission::whereIn('assignment_id', $assignmentIds)
            ->with('grade')
            ->get()
            ->groupBy('student_id');

        return view('lecturer.courses.grades-recap', compact('course', 'assignments', 'enrollments', 'submissions'));
    }
}
