<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assigners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('prototype_id');
			$table->integer('test_id')->index()->default(0);
			$table->timestamp('date_end');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assigners');
	}

}
