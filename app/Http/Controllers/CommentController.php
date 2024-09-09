<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $comment = $request->validated();
        $comment['writer_id'] = 1;
        $comment = Comment::create($comment);
        return response()->json($comment);
    }
}
