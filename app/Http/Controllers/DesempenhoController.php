<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DesempenhoController extends Controller
{
    public function index(Request $request)
    {
        $stats = session('simulado_stats', [
            'total_respondidas' => 0,
            'total_corretas' => 0,
        ]);

        $totalQuestions = Question::count();
        $media = $stats['total_respondidas'] > 0
            ? round(($stats['total_corretas'] / $stats['total_respondidas']) * 100)
            : 0;

        return view('desempenho.index', compact('stats', 'totalQuestions', 'media'));
    }
}
