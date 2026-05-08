<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalAssignments = Assignment::count();
        $totalSubmissions = Submission::count();
        $user = auth()->user();

        return view('dashboard.index', compact('user', 'totalUsers', 'totalCourses', 'totalAssignments', 'totalSubmissions'));
    }
}



