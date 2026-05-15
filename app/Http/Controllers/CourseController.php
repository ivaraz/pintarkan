<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index()
    {
        $courses = Course::with(['lecturers', 'enrollments'])->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $lecturers = Lecturer::all();
        return view('admin.courses.create', compact('lecturers'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'lecturer_id' => ['required', 'exists:lecturers,id'],
        ], [
            'title.required' => 'Judul matkul harus diisi',
            'title.max' => 'Judul matkul maksimal 255 karakter',
            'lecturer_id.required' => 'Dosen harus dipilih',
            'lecturer_id.exists' => 'Dosen tidak valid',
        ]);

        try {
            Course::create($validated);
            $notif = array('message' => 'Matkul berhasil ditambahkan', 'alert-type' => 'success');
            return redirect()->route('admin.courses.index')->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['lecturers', 'enrollments']);
        $enrolledStudents = $course->enrollments()->with('student')->get();
        return view('admin.courses.show', compact('course', 'enrolledStudents'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $lecturers = Lecturer::all();
        return view('admin.courses.edit', compact('course', 'lecturers'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'lecturer_id' => ['required', 'exists:lecturers,id'],
        ]);

        try {
            $course->update($validated);
            $notif = array('message' => 'Matkul berhasil diperbarui', 'alert-type' => 'success');
            return redirect()->route('admin.courses.show', $course)->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            $notif = array('message' => 'Matkul berhasil dihapus', 'alert-type' => 'success');
            return redirect()->route('admin.courses.index')->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show form for adding students to a course.
     */
    public function addStudents(Course $course)
    {
        $course->load('enrollments');
        $enrolledStudentIds = $course->enrollments()->pluck('student_id')->toArray();
        $students = Student::whereNotIn('id', $enrolledStudentIds)->get();
        return view('admin.courses.add-students', compact('course', 'students'));
    }

    /**
     * Store student enrollment to a course.
     */
    public function storeEnrollment(Request $request, Course $course)
    {
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
            return redirect()->route('admin.courses.show', $course)->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove student enrollment from a course.
     */
    public function removeStudent(Course $course, Enrollment $enrollment)
    {
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
}
