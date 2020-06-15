<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Responses\Index;
use App\Http\Requests\StoreFavorite;

class FavoriteController extends Controller
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
        $whereQuery = Favorite::where('title', 'LIKE', "%{$query['keyword']}%")
        ->orWhere('comment', 'LIKE', "%{$query['keyword']}%")
        ->orderBy('order', 'DESC');
        $count = $whereQuery->count();
        $favorites = $whereQuery
        ->skip($query['skip'])
        ->take($query['take'])
        ->get();

        return Index::response($count, $query['skip'], $query['take'], $favorites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFavorite  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFavorite $request)
    {
        $validated = $request->validated();
        $favorite = new Favorite($validated);

        $favorite->save();

        return $favorite;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        return $favorite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreFavorite  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFavorite $request, Favorite $favorite)
    {
        $validated = $request->validated();
        $favorite->update($validated);

        return $favorite;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return $favorite;
    }
}
