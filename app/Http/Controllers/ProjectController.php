<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;
use App\Http\Responses\Index;

class ProjectController extends Controller
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
            'take' => $request->query('take') ?? 24
        ];

        $whereQuery = Project::where('title', 'LIKE', "%{$query['keyword']}%")
        ->orWhere('description', 'LIKE', "%{$query['keyword']}%");
        
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
     * @param  StoreProject  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProject $request)
    {
        $validated = $request->validated();
        $project = new Project($validated);

        $project->save();

        return $project;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProject  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProject $request, Project $project)
    {
        $validated = $request->validated();

        $project->update($validated);

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return $project;
    }
}
