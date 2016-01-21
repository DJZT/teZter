<?php namespace App\Http\Controllers\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Assigner;
use App\Models\Question;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {

	public $data = [];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function test(Requests\Client\Test\Test $request, Test $Test)
	{
		$this->data['Test']			= $Test;
		$Prototype 					= $Test->prototype;
		$this->data['Prototype']	= $Prototype;

		$questions_ids = [];

		foreach($Test->answers as $Answer){
			$questions_ids[] = $Answer->question_id;
		}

		if($Question = $Test->questions()->notAnswered($Test)->first()){
			$this->data['Question'] = $Question;
		}else{
			$Test->date_completed = Carbon::now();
			$Test->range = $Test->result();
			$Test->save();
			return redirect(route('client.test.info', $Test));
		}
		return view('client.test.test', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function answer(Request $request, Test $Test, Question $Question)
	{
		foreach ($request->input('answers', []) as $answer) {
			$Answer = Answer::find($answer);
			$Test->answers()->attach($Answer);
		}
		return redirect(route('client.test', $Test));
	}


	public function startTestByAssigner(Requests\Client\Assigners\Show $request, Assigner $Assigner)
	{
		$Prototype = $Assigner->prototype;

		$Test = new Test;
		$Test->fill([
			'user_id' 		=> $Assigner->user_id,
			'prototype_id'	=> $Prototype->id,
		]);

		$Questions = $Assigner->prototype->questions;
		if($Prototype->qount_questions === 0){
			$count_question = $Questions->count();
		}else{
			if($Questions->count() >= $Prototype->count_questions){
				$count_question = $Prototype->count_questions;
			}else{
				$count_question = $Questions->count();
			}
		}

		$ids = array_rand($Questions->toArray(), $count_question);
		$Test->save();
		$Assigner->test()->associate($Test);
		$Assigner->save();
		foreach($ids as $id){
			$Test->questions()->attach($Questions[$id]->id);
		}


		return redirect(route('client.test', $Test));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Requests\Client\Test\Test $request, Test $Test)
	{
		$this->data['Test'] = $Test;
		return view('client.test.info', $this->data);
	}



}
