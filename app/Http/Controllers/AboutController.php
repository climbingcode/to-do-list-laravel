<?php namespace todolist\Http\Controllers;

use todolist\Http\Requests;
use todolist\Http\Controllers\Controller;

use Illuminate\Http\Request;
use todolist\Http\Requests\ContactFormRequest;


class AboutController extends Controller {

	public function create() 
	{
		return view('about.contact');
	}

	public function store(ContactFormRequest $request) 
	{
		\Mail::send('emails.contact',
			array(
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'user_message' => $request->get('message')
			), function($message)
			{
				$message->from('thomas.davis@widerfunnel.com');
				$message->to('thomas.davis@widerfunnel.com', 'Admin')->subject('this is working!!!');
			});
		return \Redirect::route('contact')
		->with('message', 'Thanks for contacting us');
	}

}
