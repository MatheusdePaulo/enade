<?php

namespace App\Http\Controllers;

use App\Models\ForumReply;
use App\Models\ForumTopic;
use Illuminate\Http\Request;

class ForumReplyController extends Controller
{
    public function store(Request $request, ForumTopic $topic)
    {
        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        ForumReply::create([
            'body'     => $request->body,
            'user_id'  => auth()->id(),
            'topic_id' => $topic->id,
        ]);

        return back()->with('success', 'Resposta publicada!');
    }

    public function destroy(ForumReply $reply)
    {
        if (auth()->id() !== $reply->user_id && ! auth()->user()->is_admin) {
            abort(403);
        }

        $reply->delete();
        return back()->with('success', 'Resposta removida.');
    }
}
