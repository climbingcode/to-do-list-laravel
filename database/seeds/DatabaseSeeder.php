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


			foreach(range(1, 10) as $index) 
			{
				$user = new User;
				$user->name = $faker->name;
				$user->email = $faker->email;
				$user->password = 'password';
				$user->confirmation_code = null;
				$user->confirmation = rand(0, 1);
				$user->save();

				foreach(range(1, 10) as $index)
				{
					$list = new Todolist;
					$list->name = $faker->sentence(2);
					$list->description = $faker->sentence(4);
					$user->lists()->save($list);

					foreach(range(1, 10) as $index) 
					{
						$task = new Task;
						$task->name = $faker->sentence(4);
						$task->description = $faker->sentence(6);
						$list->tasks()->save($task);
					}
				}
			}
		

		DB::statement('SET FOREIGN_KEY_CHECKS = 1'); 

	}

}
