<?php namespace todolist\Http\Controllers;

use todolist\Http\Requests;
use todolist\Http\Controllers\Controller;

use todolist\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use Illuminate\Http\Request;
use Illuminate\Http\Validator;

use todolist\Http\Requests\RegistrationFormRequest;


class RegistrationController extends Controller {

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
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RegistrationFormRequest $request)
	{
	

		$confirmation_code = str_random(30);

		User::create([
			'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'confirmation_code' => $confirmation_code
		]);

		Mail::send('emails.verify',['confirmation_code' => $confirmation_code], function($message) {
			$message->to(Input::get('email'), Input::get('name'))
			->subject('verify your email!');
		});

		\Session::flash('flash_message', 'Thanks for signing up, please check your email for further instructions.');

		return \Redirect::route('WelcomeController@index');
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
