<?php

namespace App\Http\Controllers;

use App\ProjectSpace;

class ProjectSpacesController extends Controller
{

    public function show(ProjectSpace $project_space_permalink)
    {
        $this->authorize('view', $project_space_permalink);

        return view('projects.show', ['project_space' => $project_space_permalink]);
    }
}
