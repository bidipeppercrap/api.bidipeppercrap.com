<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'role:root,admin'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword', '');
        $limit = $request->query('limit', 24);
        $pinned = $request->query('pinned', false);

        $sql = [
            'title' => "IF(LENGTH(title) > 100, CONCAT(LEFT(title, 97), '...'), title) as title",
            'content' => "IF(LENGTH(content) > 140, CONCAT(LEFT(content, 137), '...'), content) as content"
        ];

        $data = Post::selectRaw("id, {$sql['title']}, {$sql['content']}, display_title, subtitle, thumbnail, pinned, created_at, updated_at")
        ->where('pinned', $pinned)
        ->where(fn($q) => $q->where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('content', 'LIKE', "%{$keyword}%")
            ->orWhere('display_title', 'LIKE', "%{$keyword}%")
            ->orWhere('subtitle', 'LIKE', "%{$keyword}%")
        )
        ->orderBy('created_at', 'DESC')
        ->paginate($limit);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = new Post($validated);

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
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePost  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $post;
    }
}
