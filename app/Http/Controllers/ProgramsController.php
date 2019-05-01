<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Program;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		return view('programs.index');
    }
	
	public function getData() {
		$programs = Program::withCount('projects')->get();
		
		return Datatables::of($programs)
			->addColumn('action', function ($program) {
                return '<a href="'.route('programs.edit', $program->id).'" title="Edit Program" class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
				<a href="#" class="btn btn-xs btn-flat btn-danger btn-delete" data-remote="'. route('programs.destroy', $program->id) .'" data-table="programs-table" title="Delete Program"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
        return view('programs.create');
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
			'title' => 'required'
		]);
        $requestData = $request->all();
		$requestData['created_by'] = Auth::user()->id;
        
        Program::create($requestData);

        return redirect('programs')->with('flash_message', 'Program added!');
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
        $program = Program::findOrFail($id);

        return view('programs.edit', compact('program'));
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
			'title' => 'required'
		]);
        $requestData = $request->all();
        
        $program = Program::findOrFail($id);
        $program->update($requestData);

        return redirect('programs')->with('flash_message', 'Program updated!');
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
        Program::destroy($id);

        return redirect('programs')->with('flash_message', 'Program deleted!');
    }
}
