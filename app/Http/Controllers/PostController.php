<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;

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
        $sql = [
            'title' => "IF(LENGTH(title) > 100, CONCAT(LEFT(title, 97), '...'), title) as title",
            'content' => "IF(LENGTH(content) > 140, CONCAT(LEFT(content, 137), '...'), content) as content"
        ];
        $posts = Post::selectRaw("id, {$sql['title']}, {$sql['content']}, display_title, subtitle, thumbnail, pinned, created_at, updated_at")
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
     * @param  \App\Http\Requests\UpdatePost  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePost $request, Post $post)
    {
        error_log("WEre");
        // $validated = $request->validated();
        // $validated->pinned ??= false;
        // $post->title = $validated->title;
        // $post->content = $validated->content;
        // $post->display_title = $validated->display_title;
        // $post->subtitle = $validated->subtitle;
        // $post->thumbnail = $validated->thumbnial;
        // $post->pinned = $validated->pinned;
        //$post->save();

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
