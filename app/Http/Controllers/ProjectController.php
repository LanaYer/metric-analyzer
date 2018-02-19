<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    protected $redirectTo = '/home';

    public function index(Project $project)
    {
        return view('project.update', ['project' => $project]);
    }

    public function add(Request $request)
    {
        Project::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'url' => $request->url,
            'ym_login' => $request->ym_login,
            'ym_token' => $request->ym_token
        ]);
        return redirect('/dashboard');
    }

    public function update(Request $request)
    {
        $project = Project::find($request->id);
        $isActive = 0;

        if ($request->is_active){
            $isActive = 1;
        }

        $project->name = $request->name;
        $project->url = $request->url;
        $project->ym_login = $request->ym_login;
        $project->ym_token = $request->ym_token;
        $project->is_active = $isActive;

        $project->save();

        return redirect('/dashboard');
    }
}
