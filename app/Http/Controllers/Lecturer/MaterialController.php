<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('lecturer.materials.create', compact('course'));
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
            'content' => 'nullable|string',
            'file.*' => 'nullable|file|max:10240',
        ]);

        $filePaths = [];

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $filePaths[] = $file->storeAs('materials', $fileName, 'public');
            }
        }

        Material::create([
            'course_id' => $course->id,
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'files' => !empty($filePaths) ? $filePaths : null,
        ]);

        return redirect()
            ->route('lecturer.courses.show', $course)
            ->with([
                'alert-type' => 'success',
                'message' => 'Materi berhasil ditambahkan.',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Material $material)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($material->course_id !== $course->id) {
            abort(404);
        }

        return view('lecturer.materials.show', compact('course', 'material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Material $material)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($material->course_id !== $course->id) {
            abort(404);
        }

        return view('lecturer.materials.edit', compact('course', 'material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course, Material $material)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($material->course_id !== $course->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file.*' => 'nullable|file|max:10240',
        ]);

        $filePaths = $material->files ?? [];

        // Hapus file yang dipilih untuk dihapus
        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $fileToDelete) {
                if (($key = array_search($fileToDelete, $filePaths)) !== false) {
                    Storage::disk('public')->delete($fileToDelete);
                    unset($filePaths[$key]);
                }
            }
            $filePaths = array_values($filePaths);
        }

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $filePaths[] = $file->storeAs('materials', $fileName, 'public');
            }
        }

        $material->update([
            'title' => $validated['title'],
            'content' => $validated['content'] ?? null,
            'files' => !empty($filePaths) ? $filePaths : null,
        ]);

        return redirect()
            ->route('lecturer.courses.show', $course)
            ->with([
                'alert-type' => 'success',
                'message' => 'Materi berhasil diperbarui.',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Material $material)
    {
        if ($course->lecturer_id !== auth()->user()->lecturer->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($material->course_id !== $course->id) {
            abort(404);
        }

        if (!empty($material->files)) {
            foreach ($material->files as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $material->delete();

        return redirect()
            ->route('lecturer.courses.show', $course)
            ->with([
                'alert-type' => 'success',
                'message' => 'Materi berhasil dihapus.',
            ]);
    }
}
