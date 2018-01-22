<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    protected $redirectTo = '/home';

    public function index($id)
    {
        $project = Project::where('id', $id)->get();

        return view('project.update', ['project' => $project ]);
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
        return redirect('/index');
    }

    public function update(Request $request)
    {

    }
}
