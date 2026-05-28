<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents   = User::where('is_admin', false)->count();
        $totalQuestions  = Question::count();
        $totalCourses    = Course::count();
        $topQuestion     = Question::with('course')->orderByDesc('times_answered')->first();

        $questions = Question::with('course')
            ->orderByDesc('is_featured')
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->paginate(15);

        $courses = Course::orderBy('name')->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalQuestions', 'totalCourses',
            'topQuestion', 'questions', 'courses'
        ));
    }
}
