<?php

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWish;
use App\Http\Requests\UpdateWish;

class WishController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt', 'role:root'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword', '');
        $limit = $request->query('limit', 24);

        $data = Wish::where('title', 'LIKE', "%{$keyword}%")
        ->orWhere('comment', 'LIKE', "%{$keyword}%")
        ->orderBy('order', 'DESC')
        ->paginate($limit);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWish  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWish $request)
    {
        $validated = $request->validated();
        $wish = new Wish($validated);

        $wish->save();

        return $wish;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function show(Wish $wish)
    {
        return $wish;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateWish  $request
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWish $request, Wish $wish)
    {
        $validated = $request->validated();
        $wish->update($validated);

        return $wish;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wish  $wish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wish $wish)
    {
        $wish->delete();

        return $wish;
    }
}
