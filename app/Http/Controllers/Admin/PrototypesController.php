<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Models\Prototype;
use Illuminate\Http\Request;

class PrototypesController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['Prototypes'] = Prototype::all();
		return view('admin.prototypes.list', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.prototypes.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Prototypes\Store $request)
	{
		$Prototype = Prototype::create($request->input('prototype'));
		return redirect(route('admin.prototypes.edit', $Prototype));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Prototype $Prototype)
	{
		$this->data['breadcrumbs'][]	= ['link' => route('admin.prototypes.list'), 'title' => 'Прототипы'];
		$this->data['breadcrumbs'][]	= ['link' => false, 'title' => $Prototype->title];
		$this->data['Prototype']	= $Prototype;
		return view('admin.prototypes.edit', $this->data);
	}

	/**
	 * @param Request $request
	 * @param Prototype $Prototype
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Request $request, Prototype $Prototype)
	{
		$Prototype->fill($request->input('prototype'));
		$Prototype->save();
		return redirect(route('admin.prototypes.edit', $Prototype));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Prototype $Prototype){
		if($count = $Prototype->tests()->count()){
			return redirect()->back()->withErrors('errors', 'На основе прототипа теста №'.$Prototype->id.' уже было пройдено '.$count.' тестов. Невозможно удалить данный прототип.');
		}else{
			$Prototype->delete();
			$Prototype->save();
			return redirect()->back();
		}
	}

	/**
	 * @param Prototype $Prototype
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function restore(Prototype $Prototype){
		$Prototype->restore();
		$Prototype->save();
		return redirect(route('admin.prototypes.list'));
	}

}
