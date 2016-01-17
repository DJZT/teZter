<?php namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {

	protected $fillable = ['title', 'default', 'admin'];

    use SoftDeletes;

    public function users(){
        return $this->hasMany(User::class);
    }

}
