<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class SimuladoController extends Controller
{
    public function index(Request $request)
    {
        $courses      = Course::withCount('questions')->get();
        $years        = Question::select('year')->distinct()->orderByDesc('year')->pluck('year');
        $userCourseId = $request->user()->course_id;

        return view('simulado.index', compact('courses', 'years', 'userCourseId'));
    }

    public function iniciar(Request $request)
    {
        $request->validate([
            'course_id'  => 'nullable|exists:courses,id',
            'component'  => 'nullable|in:Geral,Específico',
            'year'       => 'nullable|integer',
            'quantidade' => 'required|integer|min:1|max:50',
        ]);

        $query = Question::with('alternatives');

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        if ($request->filled('component')) {
            $query->where('component', $request->component);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $questions = $query->inRandomOrder()->limit($request->quantidade)->get();

        if ($questions->isEmpty()) {
            return back()->with('error', 'Nenhuma questão encontrada com os filtros selecionados.');
        }

        session([
            'simulado' => [
                'question_ids' => $questions->pluck('id')->toArray(),
                'answers'      => [],
                'started_at'   => now()->timestamp,
                'duration'     => 60 * 60,
            ],
        ]);

        return redirect()->route('simulado.show', ['index' => 0]);
    }

    public function show(int $index)
    {
        $simulado = session('simulado');

        if (!$simulado) {
            return redirect()->route('simulado.index');
        }

        $questionIds = $simulado['question_ids'];
        $total       = count($questionIds);

        if ($index < 0 || $index >= $total) {
            return redirect()->route('simulado.show', ['index' => 0]);
        }

        $question  = Question::with('alternatives')->findOrFail($questionIds[$index]);
        $elapsed   = now()->timestamp - $simulado['started_at'];
        $remaining = max(0, $simulado['duration'] - $elapsed);

        if ($remaining === 0) {
            return redirect()->route('simulado.resultado');
        }

        $answers = $simulado['answers'];

        return view('simulado.show', compact('question', 'index', 'total', 'remaining', 'answers', 'questionIds'));
    }

    public function responder(Request $request, int $index)
    {
        $request->validate(['alternative_id' => 'required|exists:alternatives,id']);

        $simulado = session('simulado');

        if (!$simulado) {
            return redirect()->route('simulado.index');
        }

        $simulado['answers'][$simulado['question_ids'][$index]] = $request->alternative_id;
        session(['simulado' => $simulado]);

        $nextIndex = $index + 1;
        $total     = count($simulado['question_ids']);

        if ($nextIndex >= $total) {
            return redirect()->route('simulado.resultado');
        }

        return redirect()->route('simulado.show', ['index' => $nextIndex]);
    }

    public function resultado()
    {
        $simulado = session('simulado');

        if (!$simulado || empty($simulado['answers'])) {
            return redirect()->route('simulado.index');
        }

        $questionIds = $simulado['question_ids'];
        $answers     = $simulado['answers'];
        $questions   = Question::with('alternatives')->whereIn('id', $questionIds)->get()->keyBy('id');

        $results  = [];
        $corretas = 0;

        foreach ($questionIds as $qId) {
            $question = $questions[$qId] ?? null;
            if (!$question) continue;

            $chosenId = $answers[$qId] ?? null;
            $chosen   = $chosenId ? $question->alternatives->firstWhere('id', $chosenId) : null;
            $correct  = $question->alternatives->firstWhere('is_correct', true);
            $acertou  = $chosen && $chosen->is_correct;

            if ($acertou) $corretas++;

            $results[] = [
                'question' => $question,
                'chosen'   => $chosen,
                'correct'  => $correct,
                'acertou'  => $acertou,
            ];
        }

        $total      = count($results);
        $percentual = $total > 0 ? round(($corretas / $total) * 100) : 0;
        $elapsed    = now()->timestamp - $simulado['started_at'];
        $tempoGasto = gmdate('H:i:s', min($elapsed, $simulado['duration']));

        $stats = session('simulado_stats', ['total_respondidas' => 0, 'total_corretas' => 0]);
        $stats['total_respondidas'] += $total;
        $stats['total_corretas']    += $corretas;
        session(['simulado_stats' => $stats]);

        session()->forget('simulado');

        return view('simulado.resultado', compact('results', 'total', 'corretas', 'percentual', 'tempoGasto'));
    }
}
