<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Group;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class UsersController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$Users = User::with('role');

		$this->data['Users'] = User::paginate(3);
		return view('admin.users.list', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data['Roles'] 	= Role::all();
		$this->data['Groups']	= Group::all();
		return view('admin.users.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Users\Create $request)
	{
		$User = User::create($request->all());
		return redirect(route('admin.users.show', $User));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $User)
	{
		$this->data['User'] = $User;
		return view('admin.users.show', $this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(User $User)
	{
		$this->data['Roles'] 	= Role::all();
		$this->data['Groups']	= Group::all();
		$this->data['User']	= $User;
		return view('admin.users.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\Admin\Users\Update $request, User $User)
	{
		$User->fill($request->all());
		$User->save();
		return redirect(route('admin.users.edit', $User));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(User $User)
	{
		$User->delete();
		return redirect(route('admin.users.list'));
	}

	public function removeGroup(User $User){
		$User->group_id = 0;
		$User->save();
		return redirect()->back();
	}

}
