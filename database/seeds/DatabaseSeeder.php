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

		\Illuminate\Support\Facades\DB::table('type_question')->insert([['title' => 'radio'],['title' => 'checkbox']]);

		// $this->call('UserTableSeeder');
	}

}