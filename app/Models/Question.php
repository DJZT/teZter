<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Question extends Model
{

    use SoftDeletes;

    protected $fillable = ['text', 'image', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prototype()
    {
        return $this->belongsTo(Prototype::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tests(){
        return $this->belongsToMany(Test::class);
    }

    public function result(){
        return rand(0,100)/100;
    }

    /**
     * @return bool
     */
    public function deleteImage(){
        $this->image = null;
        return true;
    }

    /**
     * @param $value
     * @return null|\SplFileInfo
     */
    public function getImageAttribute($value)
    {
        if($value && file_exists($value)){
            return new \SplFileInfo($value);
        }else{
            return null;
        }
    }

    /**
     * @param $q
     * @param $Test
     * @return mixed
     */
    public function scopeNotAnswered($q, $Test){
        $questions_ids = [];
        foreach($Test->answers as $Answer){
            $questions_ids[] = $Answer->question_id;
        }
        return $q->whereNotIn('id', $questions_ids);
    }

}