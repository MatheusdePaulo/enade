<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $courses        = Course::withCount('questions')->get();
        $totalQuestions = Question::count();

        $simuladoStats = session('simulado_stats', [
            'total_respondidas' => 0,
            'total_corretas'    => 0,
        ]);

        $selectedCourseId = $request->user()->course_id;
        $selectedCourse   = $selectedCourseId ? Course::find($selectedCourseId) : null;

        // Questão do Dia: featured primeiro; sem featured usa seed de data
        $questaoDodia = Question::with(['alternatives', 'course'])
            ->when($selectedCourseId, fn($q) => $q->where('course_id', $selectedCourseId))
            ->where('is_featured', true)
            ->inRandomOrder()
            ->first();

        if (! $questaoDodia) {
            $base  = Question::with(['alternatives', 'course'])
                ->when($selectedCourseId, fn($q) => $q->where('course_id', $selectedCourseId));
            $total = $base->count();
            if ($total > 0) {
                $offset       = abs(crc32(date('Y-m-d'))) % $total;
                $questaoDodia = $base->skip($offset)->first();
            }
        }

        return view('dashboard', compact(
            'courses', 'totalQuestions', 'simuladoStats',
            'selectedCourse', 'questaoDodia'
        ));
    }

    public function selectCourse(Request $request)
    {
        $request->validate(['course_id' => 'nullable|exists:courses,id']);
        $request->user()->update(['course_id' => $request->course_id]);

        return redirect()->route('dashboard')->with('status', 'Curso atualizado com sucesso!');
    }
}
