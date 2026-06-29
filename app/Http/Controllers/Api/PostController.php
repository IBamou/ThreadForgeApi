<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest\StorePostRequest;
use App\Http\Requests\PostRequest\UpdatePostRequest;
use App\Http\Requests\PostRequest\UpdateStatusPostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = auth()->user()->posts()->with('user')->get();

        return response()->json([
            'posts' => PostResource::collection($posts),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $post = Post::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        $post->load('user');

        return response()->json([
            'message' => 'Post created successfully.',
            'Post' => PostResource::make($post),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post->load('user');

        return response()->json([
            'Post' => PostResource::make($post),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validated();

        $post->update($validated);

        $post->load('user');

        return response()->json([
            'message' => 'Post updated successfully.',
            'Post' => PostResource::make($post),
        ], 200);
    }

    public function  UpdateStatus(UpdateStatusPostRequest $request, Post $post) {
        $this->authorize('updateStatus', $post);

        $validated = $request->validated();

        $post->update($validated);

        return response()->json([
            'message' => 'Post status updated successfully.',
        ], 200);
    }

    /**
     * Archive the specified resource from storage.
     */
    public function archive(Post $post)
    {
        $this->authorize('archive', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post archived successfully.'
        ], 200);
    }

    public function restore(Post $post)
    {
        $this->authorize('restore', $post);

        $post->restore();

        $post->load('user');

        return response()->json([
            'message' => 'Post restored successfully.',
            'Post' => PostResource::make($post),
        ], 200);
    }

    public function forceDelete(Post $post)
    {
        $this->authorize('forceDelete', $post);

        $post->forceDelete();

        return response()->json([
            'message' => 'Post deleted successfully.'
        ], 200);
    }

    public function archived()
    {
        $archived_Posts = auth()->user()->Posts()->onlyTrashed()->with('user')->get();

        return response()->json([
            'archived-Posts' => PostResource::collection($archived_Posts)
        ], 200);
    }
}
