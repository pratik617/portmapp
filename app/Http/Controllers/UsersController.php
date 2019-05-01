<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		return view('users.index');
    }

	public function getData() {
		$users = User::with('role')->get();
		
		return Datatables::of($users)
			->addColumn('action', function ($user) {
                return '<a href="'.route('users.edit', $user->id).'" title="Edit User" class="btn btn-xs btn-flat btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
				<a href="#" class="btn btn-xs btn-flat btn-danger btn-delete" data-remote="'. route('users.destroy', $user->id) .'" data-table="users-table" title="Delete User"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
		$roles = Role::all();
		
        return view('users.create', compact('roles'));
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
			'role_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
			'password' => 'required'
		]);
        $requestData = $request->all();
		$requestData['created_by'] = Auth::user()->id;
        
        User::create($requestData);

        return redirect('users')->with('flash_message', 'User added!');
    }
	
	public function changePassword(Request $request) {
		dd('got it man');
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
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
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
		$roles = Role::all();
		
        $user = User::findOrFail($id);

        return view('users.edit', compact('user', 'roles'));
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
			'role_id' => 'required',
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
		]);
        $requestData = $request->all();

		if(!isset($requestData['change_password']) || empty($requestData['password'])) {
			unset($requestData['password']);
		}
		
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('users')->with('flash_message', 'User updated!');
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
        User::destroy($id);

        return redirect('users')->with('flash_message', 'User deleted!');
    }
}
