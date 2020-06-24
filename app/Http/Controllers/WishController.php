<?php

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWish;
use App\Http\Requests\UpdateWish;
use App\Http\Responses\Index;

class WishController extends Controller
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

        $whereQuery = Wish::where('title', 'LIKE', "%{$query['keyword']}%")
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
