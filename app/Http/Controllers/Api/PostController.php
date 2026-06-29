<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostIndexResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with('category')
            ->when($request->category_id, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->latest()
            ->get();

        return PostIndexResource::collection($posts);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return new PostResource($post);
    }
}
