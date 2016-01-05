<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		\App\User::create([
			'first_name'	=> 'Stanisalv',
			'last_name'		=> 'Pochepko',
			'second_name'	=> 'Nikolaevich',
			'email'			=> 'DJZT44@gmail.com',
			'password'		=> bcrypt('123456'),
			'group_id'		=> 0,
			'role_id'		=> 0
		]);

		\Illuminate\Support\Facades\DB::table('type_question')->insert([['title' => 'radio'],['title' => 'checkbox']]);

		// $this->call('UserTableSeeder');
	}

}