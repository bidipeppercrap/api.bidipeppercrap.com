<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = [
            'keyword' => $request->query('keyword'),
            'skip' => $request->query('skip') ?? 0,
            'take' => $request->query('take') ?? 24
        ];
        $posts = Post::selectRaw('id, LEFT(title, 100), LEFT(content, 140), display_title, subtitle, thumbnail, pinned, created_at, updated_at')
            ->where('title', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('content', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('display_title', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('subtitle', 'LIKE', "%{$query['keyword']}%")
            ->orderBy('pinned', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->skip($query['skip'])
            ->take($query['take'])
            ->get();

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = new Post($validated);
        $post->pinned ??= false;

        $post->save();

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
