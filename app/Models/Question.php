<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model {

    use SoftDeletes;

    protected $fillable = ['text', 'image', 'type', 'coefficient'];

    public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
=======

class Question extends Model {

	//
>>>>>>> dc87c6a99aa9efc899098ad3472856553d8b876a

}
