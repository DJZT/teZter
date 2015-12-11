<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Test extends Model {

	public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function answered(){
        return [];
    }

    public function user(){
        return $this->belongsTo(User::class);
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
        return 0;
    }

}
