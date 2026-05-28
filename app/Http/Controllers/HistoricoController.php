<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SimuladoHistory;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $histories = SimuladoHistory::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('historico.index', compact('histories'));
    }

    public function show(SimuladoHistory $history)
    {
        abort_if($history->user_id !== auth()->id(), 403);

        $questionIds = $history->question_ids;
        $answers     = $history->answers; // [question_id => alternative_id]

        // Carrega questões com alternativas mantendo a ordem original
        $questionsMap = Question::with('alternatives')
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        // Monta a lista ordenada com resultado de cada questão
        $results = [];
        foreach ($questionIds as $qId) {
            $question = $questionsMap[$qId] ?? null;
            if (!$question) continue;

            $chosenId = $answers[$qId] ?? null;
            $chosen   = $chosenId ? $question->alternatives->firstWhere('id', (int) $chosenId) : null;
            $correct  = $question->alternatives->firstWhere('is_correct', true);

            $results[] = [
                'question' => $question,
                'chosen'   => $chosen,
                'correct'  => $correct,
                'acertou'  => $chosen && $chosen->is_correct,
            ];
        }

        return view('historico.show', compact('history', 'results'));
    }
}
