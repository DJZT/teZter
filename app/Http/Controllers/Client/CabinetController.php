<?php namespace App\Http\Controllers\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller {

	protected $data;
	/**
	 * Display a cabinet user.
	 *
	 * @return Response
	 */
	public function cabinet()
	{
		$this->data['User'] = Auth::user();
		return view('client.cabinet.profile', $this->data);
	}
}
