<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Test extends Model {

    protected $fillable = ['user_id', 'prototype_id', 'assigner_id', 'date_end'];

    protected $dates = ['date_end'];

	public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function answers(){
        return $this->belongsToMany(Answer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function assigner(){
        return $this->hasOne(Assigner::class);
    }

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function completed(){
        if(count($this->answered()) == count($this->answers)){
            $this->completed = true;
        }else{
            Log::warning('Попытка завершить тест при не всех отвеченных вопросах');
        }
        return $this;
    }

    public function result(){

        $result = 0;
        foreach($this->questions as $Question){ // Перебираем вопросы
            $countRight = $Question->answers()->where('right', true)->count();
            $rangeRight = 1/$countRight;
            $resultQuestion = 0;

            foreach ($this->answers as $Answer) { // Перебираем ответы
                if($Answer->question_id == $Question->id){
                    if($Answer->right){
                        $resultQuestion += $rangeRight;
                    }else{
                        $resultQuestion -= $rangeRight;
                    }
                }

            }

            if($resultQuestion < 0){
                $resultQuestion = 0;
            }
            $result += $resultQuestion;
        }

        return $result/$this->questions()->count();
    }

}
