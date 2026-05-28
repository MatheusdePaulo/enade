<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create()
    {
        $courses = Course::orderBy('name')->get();
        return view('admin.questions.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'statement'            => 'required|string',
            'year'                 => 'required|integer|min:2000|max:2035',
            'course_id'            => 'required|exists:courses,id',
            'component'            => 'required|in:Geral,Específico',
            'explanation'          => 'nullable|string',
            'is_featured'          => 'nullable|boolean',
            'order'                => 'nullable|integer|min:0',
            'alternatives'         => 'required|array|size:5',
            'alternatives.*.text'  => 'required|string',
            'correct_alternative'  => 'required|integer|between:0,4',
        ]);

        $question = Question::create([
            'statement'   => $data['statement'],
            'year'        => $data['year'],
            'course_id'   => $data['course_id'],
            'component'   => $data['component'],
            'explanation' => $data['explanation'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'order'       => $data['order'] ?? 0,
        ]);

        foreach ($data['alternatives'] as $index => $alt) {
            Alternative::create([
                'text'        => $alt['text'],
                'is_correct'  => $index === (int) $data['correct_alternative'],
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Questão criada com sucesso!');
    }

    public function edit(Question $question)
    {
        $question->load('alternatives');
        $courses = Course::orderBy('name')->get();
        return view('admin.questions.edit', compact('question', 'courses'));
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'statement'            => 'required|string',
            'year'                 => 'required|integer|min:2000|max:2035',
            'course_id'            => 'required|exists:courses,id',
            'component'            => 'required|in:Geral,Específico',
            'explanation'          => 'nullable|string',
            'is_featured'          => 'nullable|boolean',
            'order'                => 'nullable|integer|min:0',
            'alternatives'         => 'required|array|size:5',
            'alternatives.*.text'  => 'required|string',
            'correct_alternative'  => 'required|integer|between:0,4',
        ]);

        $question->update([
            'statement'   => $data['statement'],
            'year'        => $data['year'],
            'course_id'   => $data['course_id'],
            'component'   => $data['component'],
            'explanation' => $data['explanation'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'order'       => $data['order'] ?? 0,
        ]);

        // Replace alternatives
        $question->alternatives()->delete();
        foreach ($data['alternatives'] as $index => $alt) {
            Alternative::create([
                'text'        => $alt['text'],
                'is_correct'  => $index === (int) $data['correct_alternative'],
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Questão atualizada com sucesso!');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Questão removida com sucesso!');
    }

    public function toggleFeatured(Question $question)
    {
        $question->update(['is_featured' => ! $question->is_featured]);
        return back()->with('success', $question->is_featured ? 'Questão destacada na Prática Rápida!' : 'Destaque removido.');
    }
}
