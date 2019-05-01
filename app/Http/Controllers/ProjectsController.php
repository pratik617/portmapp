<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Program;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		return view('projects.index');
    }
	
	public function getData() {
		$projects = Project::with('program')->get();
		
		return Datatables::of($projects)
			->editColumn('start_at', function($project) {
                    return formatDate($project->start_at);
                })
			->editColumn('end_at', function($project) {
                    return formatDate($project->end_at);
                })
			->addColumn('action', function ($project) {
                return '<a href="'.route('projects.edit', $project->id).'" title="Edit Project" class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
				<a href="#" class="btn btn-xs btn-flat btn-danger btn-delete" data-remote="'. route('projects.destroy', $project->id) .'" data-table="projects-table" title="Delete Project"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
		->make(true);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
		$programs = Program::active()->select('id', 'title')->latest()->get();
        return view('projects.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'program_id' => 'required',
			'title' => 'required',
			'start_at' => 'required',
			'end_at' => 'required'
		]);
        $requestData = $request->all();
		$requestData['created_by'] = Auth::user()->id;
        
        Project::create($requestData);

        return redirect('projects')->with('flash_message', 'Project added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

		$programs = Program::active()->select('id', 'title')->latest()->get();
        return view('projects.edit', compact('project', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'program_id' => 'required',
			'title' => 'required',
			'start_at' => 'required',
			'end_at' => 'required'
		]);
        $requestData = $request->all();
        
        $project = Project::findOrFail($id);
        $project->update($requestData);

        return redirect('projects')->with('flash_message', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect('projects')->with('flash_message', 'Project deleted!');
    }
}
