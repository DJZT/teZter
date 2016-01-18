<?php namespace App\Http\Requests\Client\Assigners;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class Show extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$Assigner = $this->route('assigner');
		return $Assigner->user_id == Auth::user()->id;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
		];
	}

}
