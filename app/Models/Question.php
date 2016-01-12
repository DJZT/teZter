<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

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

    public function deleteImage(){
        $this->image = null;
        return true;
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