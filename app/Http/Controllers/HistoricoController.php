<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index(Request $request)
    {
        $stats = session('simulado_stats', [
            'total_respondidas' => 0,
            'total_corretas' => 0,
        ]);

        return view('historico.index', compact('stats'));
    }
}
