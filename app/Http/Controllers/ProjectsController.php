<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {

    }

    public function edit(Project $project)
    {

    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.show',['project' => $project]);
    }
}
