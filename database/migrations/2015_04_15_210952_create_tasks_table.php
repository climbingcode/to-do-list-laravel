<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('todolist_id')->unsigned()->nullable();
			$table->foreign('todolist_id')->references('id')->on('todolists')->onDelete('cascade');
			$table->string('name');
			$table->text('description');
			$table->integer('order')->default(0);
			$table->boolean('done')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
