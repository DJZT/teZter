<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $fillable = ['text', 'image', 'multi'];

    public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

}
