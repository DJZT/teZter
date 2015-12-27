<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prototype extends Model {

    use SoftDeletes;

	protected $fillable = ['title', 'count_questions', 'time'];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function tests(){
        return $this->hasMany(Test::class);
    }
}
