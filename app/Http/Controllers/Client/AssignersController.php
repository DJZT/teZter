<?php namespace App\Http\Controllers\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Assigner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignersController extends Controller {

	public $data = [];

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Requests\Client\Assigners\Show $request, Assigner $Assigner)
	{
		$this->data['Assigner']	= $Assigner;
		return view('client.assigner.show', $this->data);
	}
}
