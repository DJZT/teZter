<?php namespace App\Http\Requests\Admin\Users;

use App\Http\Requests\Request;

class Create extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'first_name' 	=> 'required|min:2|max:32',
			'last_name' 	=> 'required|min:2|max:32',
			'second_name' 	=> 'min:2|max:32',
            'email'         => 'required|email',
            'password'      => 'required',
            'confirm_password' => 'same:password'
		];
	}

}
