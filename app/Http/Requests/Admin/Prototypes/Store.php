<?php namespace App\Http\Requests\Admin\Prototypes;

use App\Http\Requests\Request;

class Store extends Request {

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
			'prototype.title' 			=> 'required|min:10|unique:prototypes,title',
			'prototype.time'			=> 'integer|min:1|max:720',
			'prototype.count_questions'	=> 'integer|min:0'
		];
	}

}
