<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{

    public function index($id)
    {
        $pages = Page::where('project_id', $id)->orderBy('id', 'DESC')->get();

        return view('page.index', ['pages' => $pages, 'project_id' => $id]);
    }

    public function show($id, $page_id)
    {
        $page = Page::where('id', $page_id)->get();

        return view('page.update', ['page' => $page, 'project_id' => $id]);
    }

    public function add_form($id)
    {
        return view('page.add', ['project_id' => $id]);
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
