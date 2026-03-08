<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        abort_unless($project->is_published, 404);
        return view('pages.projects.show', compact('project'));
    }
}
