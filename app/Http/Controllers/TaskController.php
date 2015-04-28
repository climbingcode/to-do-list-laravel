<?php namespace todolist\Http\Controllers;

use todolist\Http\Requests;
use todolist\Http\Controllers\Controller;

use Response;
use Input;
use Illuminate\Http\Request;

use todolist\Http\Requests\TaskFormRequest;

use todolist\Task;
use todolist\Todolist;

class TaskController extends Controller {

	public function __construct(Task $task)
	{

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($listId)
	{			
		$list = Todolist::findOrFail($listId); 
		return view('tasks.create')->with('list', $list);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TaskFormRequest $request)
	{

		$list = Todolist::findOrFail($request->get('listId'));

		$task = new Task(array(
			'name' => $request->get('name'),
			'description' => $request->get('description')
		));

		$list->tasks()->save($task);

		return Response::json(["task" => $task, 'response' => 200]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$task = Task::findOrFail($id);
		$list = Todolist::findOrFail($task->todolist_id);

		if ($task->done) 
		{
			$isDone = false;
		} else {
			$isDone = true;
		}

		$task->update([
			'done' => $isDone
		]);


		return Response::json(["task" => $task, 'response' => 200]);
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = Task::findOrFail($id);
		$list = Todolist::findOrFail($task->todolist_id);
		$task->destroy($id);	
		
		return Response::json(["task" => $task, 'response' => 200]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function sortTask(Request $request) 
	{
		
		$tasks = $request->get('tasks');
		Task::sortTasks($tasks);
		return Response::json(["message" => 'Order Changed', 'response' => 200]);
		
	}

}
