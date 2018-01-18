<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    protected $redirectTo = '/home';

    public function add(Request $request)
    {
        Project::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'url' => $request->url,
            'ym_login' => $request->ym_login,
            'ym_token' => $request->ym_token
        ]);
        return redirect('/home');
    }
}
