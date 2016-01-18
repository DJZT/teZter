<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	protected $fillable = ['text', 'image', 'right', 'question_id'];

	public function question(){
		return $this->belongsTo(Question::class);
	}
	public function tests(){
		return $this->belongsToMany(Test::class);
	}

	public function getImageAttribute($value)
	{
		if($value && file_exists($value)){
			return new \SplFileInfo($value);
		}else{
			return null;
		}

	}
}
