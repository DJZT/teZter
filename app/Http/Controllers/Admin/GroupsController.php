<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['Groups'] = Group::all();
		return view('admin.groups.list', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Groups\Create $request)
	{
		$Group = Group::create($request->all());
		return redirect(route('admin.groups.list'))->with('success', "Группа $Group->title создана!");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * @param Group $Group
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy(Group $Group)
	{
		if($count = $Group->users->count()){
			return redirect(route('admin.groups.list'))->with('error', "В группе есть пользователи ($count)");
		}
		$Group->delete();
		return redirect(route('admin.groups.list'));
	}

}
