<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProject;
use App\Http\Requests\UpdateProject;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt', 'role:root'])->except(['index', 'show']);
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

        $data = Project::where('title', 'LIKE', "%{$keyword}%")
        ->orWhere('description', 'LIKE', "%{$keyword}%")
        ->orderBy('order', 'DESC')
        ->paginate($limit);

        return $data;
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
