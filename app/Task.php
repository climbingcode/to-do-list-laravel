<?php namespace todolist;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

	public function Todolist() 
	{
		return $this->belongsTo('todolist\Todolist');
	}

	// STRONG PARAMS 
	protected $fillable = ['name', 'description', 'done', 'order'];

	//UPDATE ORDER OF TASKS 

	public static function sortTasks($tasks) {
		foreach ($tasks as $key => $val) {
			$taskRec = Task::find($val['taskId']);
			$taskRec->update([
				'order' => intval($val['order'])
			]);
		}
	}

}
