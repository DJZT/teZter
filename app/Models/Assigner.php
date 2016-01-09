<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Assigner extends Model {

	protected $fillable = ['date_end', 'user_id', 'prototype_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }

}
