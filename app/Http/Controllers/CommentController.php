<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, $newsId)
    {
        // dd($request->all());
        $request->validate([
            "text" => "required",
        ]);

        $comment = Comment::create([
            "news_id" => $newsId,
            "user_id" => auth()->user()->id,
            "text" => $request->text,
        ]);
        // dd($comment);
        return back();
    }
}
