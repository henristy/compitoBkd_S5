<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects', [
            'projects' => auth()->user()->projects,
            'message' => [
                'type' => session()->get('type'),
                'text' => session()->get('message')
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['created_at'] = now();
        $data['updated_at'] = now();
        Project::create($data);
        return redirect()->action([ProjectController::class, 'index'])->with('message', 'Project created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        return view('project-details', [
            'project' => $project->load('activities'),
            'message' => [
                'type' => session()->get('type'),
                'text' => session()->get('message')
            ],
            'addActivity' => session()->get('addActivity'),
            'modActivityId' => session()->get('editActivityId')
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project-edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project) {
        
        $data = $request->validated();
        $data['updated_at'] = now();
        $project->update($data);
        return redirect()->action([ProjectController::class, 'index'])->with('message', 'Project updated successfully')->with('type', 'success');
        
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->action([ProjectController::class, 'index'])->with('message', 'Project deleted successfully')->with('type', 'success');

    }
    
}
