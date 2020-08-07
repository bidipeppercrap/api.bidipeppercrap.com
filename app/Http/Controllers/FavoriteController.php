<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFavorite;
use App\Http\Requests\UpdateFavorite;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt', 'role:root'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword', '');
        $limit = $request->query('limit', 24);

        $data = Favorite::where('title', 'LIKE', "%{$keyword}%")
        ->orWhere('comment', 'LIKE', "%{$keyword}%")
        ->orderBy('order', 'DESC')
        ->paginate($limit);

        return $data;
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
