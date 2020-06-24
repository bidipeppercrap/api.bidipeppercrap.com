<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Http\Responses\Index;

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
     * @return Index
     */
    public function index(Request $request)
    {
        $query = [
            'keyword' => $request->query('keyword'),
            'skip' => $request->query('skip') ?? 0,
            'take' => $request->query('take') ?? 24,
            'pinned' => $request->query('pinned') ? true : false
        ];

        $sql = [
            'title' => "IF(LENGTH(title) > 100, CONCAT(LEFT(title, 97), '...'), title) as title",
            'content' => "IF(LENGTH(content) > 140, CONCAT(LEFT(content, 137), '...'), content) as content"
        ];

        $whereQuery = Post::selectRaw("id, {$sql['title']}, {$sql['content']}, display_title, subtitle, thumbnail, pinned, created_at, updated_at")
        ->where('pinned', $query['pinned'])
        ->where(fn($q) => $q->where('title', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('content', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('display_title', 'LIKE', "%{$query['keyword']}%")
            ->orWhere('subtitle', 'LIKE', "%{$query['keyword']}%")
        );

        $count = $whereQuery->count();

        $data = $whereQuery
        ->orderBy('created_at', 'DESC')
        ->skip($query['skip'])
        ->take($query['take'])
        ->get();

        $response = Index::response($count, $query['skip'], $query['take'], $data);

        return $response;
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
