<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:sanctum", "role:admin"])->except(["index", "show"]);
    }

    /**
     * @OA\Get(
     * path="/api/posts",
     * summary="Get a list of posts",
     * tags={"Posts"},
     * @OA\Response(
     * response=200,
     * description="List of posts",
     * ),
     * )
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * @OA\Get(
     * path = "/api/posts/{post}",
     * summary = "Get post by id",
     * tags={"Posts"},
     *     @OA\Parameter(
     *         name="post id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     * @OA\Response(
     *   response=200,
     *   description="",
     * ), 
     * @OA\Response(
     * response = 404,
     * description = "Post not found"
     * ),
     * )
     */
    public function show(Post $post)
    {

        $post->increment("views");

        return new PostResource($post);
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Create a post",
     *     tags={"Posts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StorePostRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/PostResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
