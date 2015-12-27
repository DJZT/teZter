<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	protected $fillable = ['text', 'image', 'right'];

	public function question(){
		return $this->belongsTo(Question::class);
	}
	public function tests(){
		return $this->belongsToMany(Test::class);
	}
}
