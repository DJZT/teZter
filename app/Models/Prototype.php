<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prototype extends Model {

	protected $fillable = ['title'];

    public function tests(){
        $this->hasMany(Test::class);
    }

    public function questions(){
        $this->hasMany(Question::class);
    }


}
