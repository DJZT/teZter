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

		$Role1 = \App\Models\Role::create([
			'title'		=> 'Пользователь',
			'default'	=> true
		]);

		$Role2 = \App\Models\Role::create([
			'title'		=> 'Администратор',
			'admin'		=> true
		]);

		\App\Models\Group::create([
			'title'	=> 'КИТ-10'
		]);

		$Group1 = \App\Models\Group::create([
				'title'	=> 'КИТ-10'
		]);

		\App\Models\Group::create([
				'title'	=> 'КИТ-20'
		]);

		$Group2 = \App\Models\Group::create([
				'title'	=> 'КИТ-30'
		]);

		 \App\Models\Group::create([
				'title'	=> 'КИТ-40'
		]);

		\App\User::create([
			'first_name'	=> 'Stanisalv',
			'last_name'		=> 'Pochepko',
			'second_name'	=> 'Nikolaevich',
			'email'			=> 'DJZT44@gmail.com',
			'password'		=> bcrypt('123456'),
			'group_id'		=> $Group2->id,
			'role_id'		=> $Role2->id
		]);

		\App\User::create([
			'first_name'	=> 'Test first name',
			'last_name'		=> 'Test last name',
			'second_name'	=> 'Test second name',
			'email'			=> 'test@test.com',
			'password'		=> bcrypt('123456'),
			'group_id'		=> $Group1->id,
			'role_id'		=> $Role1->id
		]);

		\Illuminate\Support\Facades\DB::table('type_question')->insert([['title' => 'radio'],['title' => 'checkbox']]);

		$Prototype = \App\Models\Prototype::create([
				'title'				=> 'Тест по биологии',
				'time'				=> 40,
				'count_questions'	=> 5
		]);

		$Question = \App\Models\Question::create([
			'prototype_id'	=> $Prototype->id,
			'text'			=> 'Сколько лап у ежа?',
			'type'			=> 'radio'
	]);

		$Answer = \App\Models\Answer::create([
				'text'			=> '4',
				'right'			=> true,
				'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
				'text'			=> '6',
				'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
				'text'			=> 'Много',
				'question_id'	=> $Question->id
		]);

		$Question = \App\Models\Question::create([
				'prototype_id'	=> $Prototype->id,
				'text'			=> 'Какая длина хобота у слона?',
				'type'			=> 'radio'
		]);

		$Answer = \App\Models\Answer::create([
				'text'			=> 'У слона нет хобота',
				'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
				'text'			=> '2 метра',
				'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
				'text'			=> 'Зависит от возраста',
				'right'			=> true,
				'question_id'	=> $Question->id
		]);

		$Question = \App\Models\Question::create([
				'prototype_id'	=> $Prototype->id,
				'text'			=> 'Сколько рёбер у человека?',
				'type'			=> 'radio'
		]);

		$Answer = \App\Models\Answer::create([
				'text'			=> '12 пар',
				'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
				'text'			=> 'Кто такой человек?',
				'right'			=> true,
				'question_id'	=> $Question->id
		]);


		// $this->call('UserTableSeeder');
	}

}