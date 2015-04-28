<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use todolist\Todolist;
use todolist\Task;
use todolist\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		$faker = \Faker\Factory::create();

		Todolist::truncate();

		foreach(range(1, 50) as $index)
		{

			$user = User::create([
				'name' => $faker->name,
				'email' => $faker->email,
				'password' => 'password',
				'confirmation_code' => mt_rand(0, 9),
				'confirmation' => rand(0,1) == 1
			]);

			$list = Todolist::create([
				'name' => $faker->sentence(2),
				'description' => $faker->sentence(4),
			]);

			// BUILD SOME TASKS FOR EACH LIST ITEM
			foreach(range(1, 10) as $index) 
			{
				$task = new Task;
				$task->name = $faker->sentence(2);
				$task->description = $faker->sentence(4);
				$list->tasks()->save($task);
			}

		}

		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 

	}

}
