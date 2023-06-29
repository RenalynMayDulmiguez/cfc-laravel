<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        return $comment;
    }

    public function store(Request $request)
    {
        $comment = Comment::query()->find($request->taskId);
        if (!$comment) {
            Comment::create([
                'task_id' => $request->taskId,
                'body' => $request->body
            ]);
        } else {
            $comment->update([
                'body' => $request->body
            ]);
        }


        return redirect()->back();
    }
}
