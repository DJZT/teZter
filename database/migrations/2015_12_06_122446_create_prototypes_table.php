<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrototypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prototypes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 2048);
			$table->integer('count_questions')->default(0);
			$table->integer('time')->default(10);
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
		Schema::dropIfExists('prototypes');
	}

}
