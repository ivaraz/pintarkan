<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Lecturer;

class WelcomeController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'courses' => Course::count(),
            'instructors' => Lecturer::count(),
        ];

        return view('welcome', compact('stats'));
    }
}
