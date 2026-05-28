<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        $query   = Question::with(['alternatives', 'course']);

        // course_id resolution:
        // • param present in URL (even empty string) → user explicitly chose; respect it
        // • param absent (first load)                → fall back to user's saved preference
        if ($request->has('course_id')) {
            $activeCourseId = $request->course_id ?: null;
        } else {
            $activeCourseId = $request->user()->course_id ?: null;
        }

        if ($activeCourseId) {
            $query->where('course_id', $activeCourseId);
        }

        if ($request->filled('component')) {
            $query->where('component', $request->component);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $question = $query->inRandomOrder()->first();
        $years    = Question::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('pratica.show', compact('question', 'courses', 'years', 'activeCourseId'));
    }

    public function show(Question $question)
    {
        $question->load(['alternatives', 'course']);
        $courses        = Course::all();
        $years          = Question::select('year')->distinct()->orderByDesc('year')->pluck('year');
        $activeCourseId = null;

        return view('pratica.show', compact('question', 'courses', 'years', 'activeCourseId'));
    }
}
