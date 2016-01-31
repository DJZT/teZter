<?php namespace App\Http\Requests\Admin\Questions;

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
		$rules = [];
		$rules['question.text'] 		= 'required|min:5';
		$rules['image'] 				= 'mime:jpeg,png,gif,bmp,tif|max:4096'; // TODO
		$rules['question.type'] 		= 'required';

		$rules['answers'] =  'required';

		foreach(Request::input('answers') as $key => $item){
			$rules['answers.'.$key.'.text']		= 'required';
			$rules['answers.'.$key.'.image'] 	= 'mime:jpeg,png,gif,bmp,tif|max:4096"'; // TODO
		}
// TODO экспорт в XML. Пересмотреть вид простомотра результата теста
		return $rules;
	}

}
