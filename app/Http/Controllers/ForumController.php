<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ForumTopic;
use App\Models\Question;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumTopic::with(['user', 'course'])
            ->withCount('replies')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at');

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $topics  = $query->paginate(15)->withQueryString();
        $courses = Course::orderBy('name')->get();

        return view('forum.index', compact('topics', 'courses'));
    }

    public function create()
    {
        $courses   = Course::orderBy('name')->get();
        $questions = Question::with('course')->orderByDesc('id')->get();
        return view('forum.create', compact('courses', 'questions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'body'        => 'required|string|min:10',
            'course_id'   => 'nullable|exists:courses,id',
            'question_id' => 'nullable|exists:questions,id',
        ]);

        $topic = ForumTopic::create([
            'title'       => $data['title'],
            'body'        => $data['body'],
            'course_id'   => $data['course_id'] ?? null,
            'question_id' => $data['question_id'] ?? null,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('forum.show', $topic)->with('success', 'Tópico criado com sucesso!');
    }

    public function show(ForumTopic $topic)
    {
        $topic->increment('views');
        $topic->load(['user', 'course', 'question', 'replies.user']);

        return view('forum.show', compact('topic'));
    }

    public function destroy(ForumTopic $topic)
    {
        if (auth()->id() !== $topic->user_id && ! auth()->user()->is_admin) {
            abort(403);
        }

        $topic->delete();
        return redirect()->route('forum.index')->with('success', 'Tópico removido.');
    }
}
