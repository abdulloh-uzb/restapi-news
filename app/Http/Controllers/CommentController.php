<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["getPostComments"]);
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = $request->validated();
        $comment['writer_id'] = 1;
        $comment = Comment::create($comment);
        return response()->json($comment);
    }

    public function getUserComments()
    {
        $comments = Comment::where("writer_id", auth()->id())->get();
        return new CommentResource($comments);
    }
    
    public function getPostComments(Post $post)
    {
        return CommentResource::collection($post->comments);
    }
}
