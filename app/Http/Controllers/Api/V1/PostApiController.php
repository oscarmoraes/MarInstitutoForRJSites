<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('publicado_em', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => PostResource::collection($posts),
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id) ?? Post::where('slug', $id)->first();

        if (! $post) {
            return response()->json([
                'success' => false,
                'message' => 'Matéria não encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PostResource($post),
        ]);
    }
}
