<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;

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
		$Users = User::with('role')->withTrashed();

		$this->data['Users'] = $Users->paginate(15);
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
        $pas = $request->input('password');


		$User = User::create($request->all());
        $User->password = bcrypt($pas);
        $User->save();
		return redirect(route('admin.users.edit', $User));
	}
// Локализировать календарь
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
		return redirect(route('admin.users.list'));
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

	/**
	 * @param User $User
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function restore($id)
	{
		$User = User::withTrashed()->find($id);
		$User->restore();
		return redirect(route('admin.users.list'));
	}

	/**
	 * @param User $User
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeGroup(User $User){
		$User->group_id = 0;
		$User->save();
		return redirect()->back();
	}

}
