<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prototype extends Model {

	protected $fillable = ['title', 'count_questions', 'time'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
