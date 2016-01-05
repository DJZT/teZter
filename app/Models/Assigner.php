<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Assigner extends Model {

	protected $fillable = ['date_end'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function prototype(){
        return $this->belongsTo(Prototype::class);
    }

    public function author(){
        return $this->belongsTo(User::class);
    }

}
