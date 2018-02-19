<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{

    public function index(Project $project)
    {
        return view('page.index', ['project' => $project]);
    }

    public function show(Project $project, Page $page)
    {
        return view('page.update', ['page' => $page, 'project' => $project]);
    }

    public function add_form(Project $project)
    {
        return view('page.add', ['project' => $project]);
    }

    public function add(Request $request)
    {
        Page::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'pages' => $request->page
        ]);
        return redirect('/dashboard/project/'.$request->project_id.'/page');
    }

    public function update(Request $request)
    {
        $page = Page::find($request->page_id);

        $page->name = $request->name;
        $page->pages = $request->page;

        $page->save();

        return redirect('/dashboard/project/'.$page->project_id.'/page');
    }
}
