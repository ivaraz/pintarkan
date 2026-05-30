<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Lecturer\DashboardController as LecturerDashboardController;
use App\Http\Controllers\Lecturer\CourseController as LecturerCourseController;
use App\Http\Controllers\Lecturer\AssignmentController as LecturerAssignmentController;
use App\Http\Controllers\Lecturer\MaterialController as LecturerMaterialController;
use App\Http\Controllers\Lecturer\StudentController as LecturerStudentController;
use App\Http\Controllers\Lecturer\GradeController as LecturerGradeController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
->prefix('admin')
->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])
        ->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])
        ->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');

    // Course Management Routes
    Route::get('/courses', [AdminCourseController::class, 'index'])
        ->name('admin.courses.index');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])
        ->name('admin.courses.create');
    Route::post('/courses', [AdminCourseController::class, 'store'])
        ->name('admin.courses.store');
    Route::get('/courses/{course}', [AdminCourseController::class, 'show'])
        ->name('admin.courses.show');
    Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])
        ->name('admin.courses.edit');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])
        ->name('admin.courses.update');
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])
        ->name('admin.courses.destroy');
    Route::get('/courses/{course}/add-students', [AdminCourseController::class, 'addStudents'])
        ->name('admin.courses.add-students');
    Route::post('/courses/{course}/enrollment', [AdminCourseController::class, 'storeEnrollment'])
        ->name('admin.courses.store-enrollment');
    Route::delete('/courses/{course}/enrollment/{enrollment}', [AdminCourseController::class, 'removeStudent'])
        ->name('admin.courses.remove-student');
});


Route::middleware(['auth', 'role:lecturer'])
->prefix('lecturer')
->group(function () {
    Route::get('/dashboard', [LecturerDashboardController::class, 'index'])
        ->name('lecturer.dashboard');

    // Course Management Routes for Lecturers
    Route::get('/courses', [LecturerCourseController::class, 'index'])
        ->name('lecturer.courses.index');
    Route::get('/courses/create', [LecturerCourseController::class, 'create'])
        ->name('lecturer.courses.create');
    Route::post('/courses', [LecturerCourseController::class, 'store'])
        ->name('lecturer.courses.store');
    Route::get('/courses/{course}', [LecturerCourseController::class, 'show'])
        ->name('lecturer.courses.show');
    Route::get('/courses/{course}/edit', [LecturerCourseController::class, 'edit'])
        ->name('lecturer.courses.edit');
    Route::put('/courses/{course}', [LecturerCourseController::class, 'update'])
        ->name('lecturer.courses.update');
    Route::delete('/courses/{course}', [LecturerCourseController::class, 'destroy'])
        ->name('lecturer.courses.destroy');
    Route::get('/courses/{course}/students', [LecturerCourseController::class, 'students'])
        ->name('lecturer.courses.students');
    Route::post('/courses/{course}/enrollment', [LecturerCourseController::class, 'storeEnrollment'])
        ->name('lecturer.courses.store-enrollment');
    Route::delete('/courses/{course}/enrollment/{enrollment}', [LecturerCourseController::class, 'removeStudent'])
        ->name('lecturer.courses.remove-student');
    Route::get('/courses/{course}/grades-recap', [LecturerCourseController::class, 'gradesRecap'])
        ->name('lecturer.courses.grades-recap');

    // Material Management Routes for Lecturers
    Route::get('/courses/{course}/materials/create', [LecturerMaterialController::class, 'create'])
        ->name('lecturer.materials.create');
    Route::post('/courses/{course}/materials', [LecturerMaterialController::class, 'store'])
        ->name('lecturer.materials.store');
    Route::get('/courses/{course}/materials/{material}', [LecturerMaterialController::class, 'show'])
        ->name('lecturer.materials.show');
    Route::get('/courses/{course}/materials/{material}/edit', [LecturerMaterialController::class, 'edit'])
        ->name('lecturer.materials.edit');
    Route::put('/courses/{course}/materials/{material}', [LecturerMaterialController::class, 'update'])
        ->name('lecturer.materials.update');
    Route::delete('/courses/{course}/materials/{material}', [LecturerMaterialController::class, 'destroy'])
        ->name('lecturer.materials.destroy');

    // Assignment Management Routes for Lecturers
    Route::get('/courses/{course}/assignments/create', [LecturerAssignmentController::class, 'create'])
        ->name('lecturer.assignments.create');
    Route::post('/courses/{course}/assignments', [LecturerAssignmentController::class, 'store'])
        ->name('lecturer.assignments.store');
    Route::get('/courses/{course}/assignments/{assignment}', [LecturerAssignmentController::class, 'show'])
        ->name('lecturer.assignments.show');
    Route::post('/assignments/{assignment}/submissions/{submission}/grade', [LecturerAssignmentController::class, 'grade'])
        ->name('lecturer.assignments.grade');
    Route::get('/students', [LecturerStudentController::class, 'index'])
        ->name('lecturer.students.index');
    Route::get('/grades', [LecturerGradeController::class, 'index'])
        ->name('lecturer.grades.index');

});

Route::middleware(['auth', 'role:student'])
->prefix('student')
->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');

    Route::get('/courses/{course}', [StudentCourseController::class, 'show'])
        ->name('student.courses.show');

    Route::get('/courses/{course}/materials/{material}', [StudentCourseController::class, 'showMaterial'])
        ->name('student.materials.show');

    Route::get('/courses/{course}/assignments/{assignment}', [StudentAssignmentController::class, 'show'])
        ->name('student.assignments.show');

    Route::post('/assignments/{assignment}/submissions', [StudentAssignmentController::class, 'submit'])
        ->name('student.assignments.submit');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('lecturer')) {
        return redirect()->route('lecturer.dashboard');
    } elseif ($user->hasRole('student')) {
        return redirect()->route('student.dashboard');
    }
    abort(403);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
