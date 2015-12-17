<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Prototype;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller {

	protected $data = [];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Prototype $Prototype)
	{
		$this->data['Prototype'] = $Prototype;
		return view('admin.questions.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Questions\Store $request)
	{
		$Question = Question::create($request->input('question'));
		if($request->has('question_image')){
			// Загрузка изображения
		}

		foreach($request->input('answers') as $answer){
			$Answer = Answer::create([
				'text'	=> $answer['text'],
				'right'	=> $answer['right'] or false
			]);

			if($answer['image']){
				// Загрузка изображения
			}
		}

		return redirect();
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

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
