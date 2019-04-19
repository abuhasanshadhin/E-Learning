<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\CommentReply;

class CommentsController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'lesson_id' => 'required'
        ]);

        Comment::create([
            'lesson_id' => $request->lesson_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        return redirect()->back();
    }

    public function addCommentReply(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'comment_id' => 'required',
            'reply' => 'required'
        ]);

        CommentReply::create($request->all());

        return redirect()->back();
    }
}
