<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Assigner;
use App\Models\Prototype;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignersController extends Controller {

	public $data = [];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['Assigners'] = Assigner::paginate(25);
		return view('admin.assigners.list', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Requests\Admin\Assigners\CreateFromUsers $request)
	{
		$this->data['Users'] 		= User::whereIn('id', $request->input('ids'))->get();
		$this->data['Prototypes']	= Prototype::all();
		return view('admin.assigners.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Assigners\Store $request)
	{
		foreach($request->input('ids') as $id){
			Assigner::create([
				'prototype_id'	=> $request->input('prototype_id'),
				'user_id'		=> $id
			]);
		}

		return redirect(route('admin.assigners.list'));
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Assigner $Assigner)
	{
		$Assigner->delete();
		return redirect()->back();
	}

}
