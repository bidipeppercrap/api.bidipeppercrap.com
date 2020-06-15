<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContact;
use App\Http\Responses\Index;

class ContactController extends Controller
{
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
            'take' => $request->query('take') ?? 100
        ];

        $whereQuery = Contact::where('title', 'LIKE', "%{$query['keyword']}%");

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
     * @param  StoreContact  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {
        $validated = $request->validated();
        $contact = new Contact($validated);

        $contact->save();

        return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreContact  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContact $request, Contact $contact)
    {
        $validated = $request->validated();
        $contact->update($validated);

        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return $contact;
    }
}
