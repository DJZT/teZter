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
			'first_name'	=> 'Admin',
			'last_name'		=> 'Admin',
			'second_name'	=> 'Admin',
			'email'			=> 'admin@admin.com',
			'password'		=> bcrypt('admin'),
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

		$Question = \App\Models\Question::create([
			'prototype_id'	=> $Prototype->id,
			'text'			=> 'Какие типы данных из перечисленных есть в PHP?',
			'type'			=> 'checkbox'
		]);

		$Answer = \App\Models\Answer::create([
			'text'			=> 'Integer',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> 'Float',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> 'String',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> 'Char',
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> 'Array',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> 'Callbacks / Callables',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);

		$Question = \App\Models\Question::create([
			'prototype_id'	=> $Prototype->id,
			'text'			=> 'Какой оператор выполняет строгое сравнение?',
			'type'			=> 'radio'
		]);

		$Answer = \App\Models\Answer::create([
			'text'			=> '==',
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '===',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '&',
			'question_id'	=> $Question->id
		]);

		$Question = \App\Models\Question::create([
			'prototype_id'	=> $Prototype->id,
			'text'			=> 'Какой оператор не правильный?',
			'type'			=> 'radio'
		]);

		$Answer = \App\Models\Answer::create([
			'text'			=> '$a and $b',
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '$a or $b',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '! $a',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '$a => $b',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);
		$Answer = \App\Models\Answer::create([
			'text'			=> '$a <= $b',
			'right'			=> true,
			'question_id'	=> $Question->id
		]);



		// $this->call('UserTableSeeder');
	}

}