<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, $newsId)
    {
        $request->validate([
            "text" => "required",
        ]);

        $comment = Comment::create([
            "news_id" => $newsId,
            "user_id" => auth()->user()->id,
            "text" => $request->text,
        ]);
        return back();
    }

    public function reply(Request $request, $newsId)
    {
        $request->validate([
            "reply" => "required",
        ]);

        $replies = Reply::create([
            "news_id" => $newsId,
            "user_id" => auth()->user()->id,
            "comment_id" => $request->commentId,
            "reply" => $request->reply,
        ]);
        return back();
    }
}
