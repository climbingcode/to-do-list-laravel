<?php namespace todolist\Http\Controllers;

use todolist\Http\Requests;
use todolist\Http\Controllers\Controller;

use Illuminate\Http\Request;
use todolist\Todolist;
use Response;

use todolist\Http\Requests\ListFormRequest;

use Auth;

class ListController extends Controller {


	public function __contruct() 
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lists = Todolist::orderBy('created_at', 'desc')->paginate(10);
		$lists->setPath('/dev.todoparrot.com/public/lists');
		return view('lists.index')->with('lists', $lists);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('lists.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ListFormRequest $request)
	{

		$currentUser = Auth::user();

		$list = new Todolist(array(
			'name' => $request->get('name'),
			'description' => $request->get('description')
		));

		$currentUser->lists()->save($list);

		return \Redirect::route('lists.index')->with('message', ['You new list item has been added!!!']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$list = Todolist::findOrFail($id);
		return view('lists.show')->with('list', $list);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$list = Todolist::find($id);
		return view('lists.edit')->with('list', $list);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, ListFormRequest $request)
	{
		$list = Todolist::find($id);

		$list->update([
			'name' => $request->get('name'),
			'description' => $request->get('description')
		]);

		return \Redirect::route('lists.show', array($list->id))->with('message', 'Your list item has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Todolist::destroy($id);
		return \Redirect::route('lists.index')->with('message', 'list item has been deleted');
	}


	public function current_user_lists() 
	{
		$currentUser = Auth::user();
		$lists = $currentUser->lists;
		return Response::json(["lists" => $lists, 'response' => 200]);
	}

}
