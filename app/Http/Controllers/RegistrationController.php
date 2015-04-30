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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RegistrationFormRequest $request)
	{
	

		$confirmation_code = str_random(30);

		$user = new User([
			'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'confirmation_code' => $confirmation_code
		]);

		$user->save();

		Mail::send('emails.verify',['confirmation_code' => $confirmation_code], function($message) {
			$message->to(Input::get('email'), Input::get('name'))
			->subject('verify your email!');
		});

		return \Redirect::route('root')->with('messages', 'Thanks for signing up, please check your email for further instructions.');
	}

	public function confirm($confirmation_code) 
	{

		$user = User::whereConfirmationCode($confirmation_code)->first();
		
		if(!$confirmation_code) 
		{
			\Session::flash('message', 'this confirmation code does not exist');
		} elseif (!$user) 
		{
			\Session::flash('message', 'Sorry we could not find this record');
		} else 
		{
			$user->confirmation = 1;
			$user->confirmation_code = null;
			$user->save();

			return \Redirect::route('root');
		}

	}

}
