<?php namespace App;

use App\Models\Assigner;
use App\Models\Group;
use App\Models\Role;
use App\Models\Test;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mayoz\Filter\Filterable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes, Filterable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'second_name', 'email', 'password', 'role_id', 'group_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function role(){
		return $this->belongsTo(Role::class);
	}

	public function group(){
		return $this->belongsTo(Group::class);
	}

	public function tests(){
		return $this->hasMany(Test::class);
	}

	public function assigners(){
		return $this->hasMany(Assigner::class);
	}

	public function getName(){
		return $this->last_name." ".$this->first_name." ".$this->second_name;
	}

	public function range(){
		$sum = 0;
		foreach($this->tests as $Test){
			$sum += $Test->range;
		}
		return $sum;
	}

}
