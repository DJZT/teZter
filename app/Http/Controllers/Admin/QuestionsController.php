<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Prototype;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends AdminController {

	protected $data = [];

	function __construct()
	{

		$this->data['breadcrumbs'][] = ['link' => route('admin.prototypes.list'), 'title' => 'Тесты'];
	}

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
		$this->data['breadcrumbs'][]= ['link' => route('admin.prototypes.edit', $Prototype), 'title' => 'Редактирование '.$Prototype->title];
		$this->data['breadcrumbs'][]= ['link' => false, 'title' => 'Новый вопрос'];
		$this->data['Prototype'] 	= $Prototype;
		$this->data['Types']		= DB::table('type_question')->get();
		return view('admin.questions.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Admin\Questions\Store $request, Prototype $Prototype)
	{
		$Question = new Question;
		$Question->fill($request->input('question'));
		$Question->prototype()->associate($Prototype);
		$Question->save();
		if($request->has('question_image')){
			// Загрузка изображения
		}

		foreach($request->input('answers') as $answer){
			$Answer = Answer::create([
				'text'	=> $answer['text'],
				'right'	=> isset($answer['right'])
			]);

			if($answer['image']){
				// Загрузка изображения
			}

			$Question->answers()->save($Answer);
		}

		return redirect(route('admin.prototypes.edit', $Prototype));
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
	public function edit(Question $Question)
	{
		$this->data['Question']	= $Question;
		return view('admin.questions.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, Question $Question)
	{
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Question $Question)
	{
		$Question->delete();
		return redirect()->back();
	}

	public function restore(Question $Question){
		$Question->restore();
		return redirect()->back();
	}

}
