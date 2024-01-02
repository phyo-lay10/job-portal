<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function like($newsId)
    {
        $userId = Auth::user()->id;
        $isExit = LikeDislike::where('news_id', $newsId)->where('user_id', $userId)->first();

        if ($isExit) {
            if ($isExit->type == 'like') {
                return back();
            } else {
                LikeDislike::where('id', $isExit->id)->update([
                    'type' => 'like'
                ]);
                return back();
            }
        } else {
            LikeDislike::create([
                'user_id' => $userId,
                'news_id' => $newsId,
                'type' => 'like',
            ]);
            return back();
        }
    }
    public function dislike($newsId)
    {
        $userId = Auth::user()->id;
        $isExit = LikeDislike::where('news_id', $newsId)->where('user_id', $userId)->first();

        if ($isExit) {
            if ($isExit->type == 'dislike') {
                return back();
            } else {
                LikeDislike::where('id', $isExit->id)->update([
                    'type' => 'dislike'
                ]);
                return back();
            }
        } else {
            LikeDislike::create([
                'user_id' => $userId,
                'news_id' => $newsId,
                'type' => 'dislike',
            ]);
            return back();
        }
    }
}
