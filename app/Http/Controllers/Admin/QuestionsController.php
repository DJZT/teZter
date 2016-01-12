<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Prototype;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends AdminController {

	protected $data = [];

	function __construct()
	{
		$this->data['breadcrumbs'][]	= ['link' => route('admin.prototypes.list'), 'title' => 'Прототипы'];
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Prototype $Prototype)
	{
		$this->data['breadcrumbs'][]= ['link' => route('admin.prototypes.edit', $Prototype), 'title' => $Prototype->title];
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Question $Question)
	{

		$this->data['breadcrumbs'][]	= ['link' => route('admin.prototypes.edit', $Question->prototype), 'title' => $Question->prototype->title];
		$this->data['breadcrumbs'][]	= ['link' => false, 'title' => 'Вопрос #'.$Question->id];
		$disk = Storage::disk('local');
		$this->data['Question']	= $Question;
		$this->data['Types']	= DB::table('type_question')->get();
		return view('admin.questions.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\Admin\Questions\Store $request, Question $Question)
	{
		$Question->fill($request->input('question'));
		$Question->save();

		if($request->hasFile('image') && $request->file('image')->isValid()){
			$QuestionImage = $request->file('image');
			$QuestionImage = $QuestionImage->move('upload\questions', $Question->id.'.'.$QuestionImage->getClientOriginalExtension());
			$Question->image = $QuestionImage->getPathname();
			$Question->save();
		}elseif($request->has('question.delete_image') && $request->input('question.delete_image') == 'on'){
			$Question->image = null;
			$Question->save();
		}

		$IdsAnswers = [];

		foreach ($request->input('answers') as $key => $answer) {
			$Answer = Answer::findOrNew($request->input('answers.'.$key.'.id'));
			$Answer->fill([
				'text'			=> $request->input('answers.'.$key.'.text'),
				'right'			=> $request->input('answers.'.$key.'.right', false),
				'question_id'	=> $Question->id
			]);
			$Answer->save();
			$IdsAnswers[] = $Answer->id;
			if($request->hasFile('answers.'.$key.'.image') && $request->file('answers.'.$key.'.image')->isValid()){
				$AnswerFile = $request->file('answers.'.$key.'.image');
				$AnswerFile = $AnswerFile->move('upload\answers', $Answer->id.'.'.$AnswerFile->getClientOriginalExtension());
				$Answer->image = $AnswerFile->getPathname();
				$Answer->save();
			}elseif($request->has('answers.'.$key.'.delete_image') && $request->input('answers.'.$key.'.delete_image') == 'on'){
				$Answer->image = null;
				$Answer->save();
			}

		}

		$AnswersForDeleting = $Question->answers()->whereNotIn('id', $IdsAnswers)->get();
		if($AnswersForDeleting->count()){
			foreach ($AnswersForDeleting as $Answer) {
				$Answer->delete();
			}
		}


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
