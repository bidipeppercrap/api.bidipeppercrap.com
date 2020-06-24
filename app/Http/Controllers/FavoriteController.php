<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavorite;
use App\Http\Requests\UpdateFavorite;
use App\Http\Responses\Index;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'role:root'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Index
     */
    public function index(Request $request)
    {
        $query = [
            'keyword' => $request->query('keyword'),
            'skip' => $request->query('skip') ?? 0,
            'take' => $request->query('take') ?? 24
        ];

        $whereQuery = Favorite::where('title', 'LIKE', "%{$query['keyword']}%")
        ->orWhere('comment', 'LIKE', "%{$query['keyword']}%");

        $count = $whereQuery->count();

        $data = $whereQuery
        ->orderBy('order', 'DESC')
        ->skip($query['skip'])
        ->take($query['take'])
        ->get();

        $response = Index::response($count, $query['skip'], $query['take'], $data);

        return $response;
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
     * @param  UpdateFavorite  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFavorite $request, Favorite $favorite)
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
