<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller {

	public $data = [];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['Roles']	= Role::all();
		return view('admin.roles.list', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		Role::create($request->all());
		return redirect()->back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Role $Role)
	{
		$this->data['Role']	= $Role;
		return view('admin.roles.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Role $Role)
	{
		$Role->fill($request->all());
		$Role->save();
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Role $Role)
	{
		if($count = $Role->users()->count()){
			return redirect(route('admin.roles.list'))->with('error', "Невозможно удалить роль. Данная роль назначена $count пользователям");
		}else{
			$Role->delete();
		}
		return redirect(route('admin.roles.list'))->with('success', "Роль $Role->title успешно удалена");
	}

}
