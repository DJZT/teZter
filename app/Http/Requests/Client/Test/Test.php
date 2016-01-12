<?php namespace App\Http\Requests\Client\Test;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class Test extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$Test = $this->route('test');
		return ($Test->user_id == Auth::user()->id)? true : false;
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
