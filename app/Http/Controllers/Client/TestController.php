<?php namespace App\Http\Controllers\Client;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller {

	public $data = [];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function test(Test $Test)
	{
		$this->data['Test']			= $Test;
		$Prototype 					= $Test->prototype;
		$this->data['Prototype']	= $Prototype;

		$questions_ids = [];

		foreach($Test->answers as $Answer){
			$questions_ids[] = $Answer->question_id;
		}

		if($Question = $Prototype->questions()->whereNotIn('id', $questions_ids)->first()){
			$this->data['Question'] = $Question;
		}else{
			$Test->date_ended = Carbon::now();
//			$Test->calculate();
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

//		print_r($Test);die();

		foreach ($request->input('answers') as $answer) {
			$Answer = Answer::find($answer);
			$Test->answers()->save($Answer);
		}

		return redirect(route('client.test', $Test));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
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
