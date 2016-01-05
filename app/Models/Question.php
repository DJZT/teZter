<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{

    use SoftDeletes;

    protected $fillable = ['text', 'image', 'type', 'coefficient'];

    public function prototype()
    {
        return $this->belongsTo(Prototype::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tests(){
        return $this->belongsToMany(Test::class);
    }

}