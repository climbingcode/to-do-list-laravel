<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::resource('registration', 'RegistrationController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

Route::get('/', ['as' => 'root', 'uses' => 'WelcomeController@index']);

Route::get('home', 'HomeController@index');

Route::get('/about', 'AboutController@index');

Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);

Route::post('contact', ['as' => 'contact_store', 'uses' => 'AboutController@store']);

Route::filter('auth', function() {
	if (Auth::guest()) return Redirect::guest(URL::route('/sign-out'));
});

$router->group(['middleware' => 'auth'], function() {
	
	Route::resource('lists', 'ListController');

	Route::get('/current_user_lists', ['as' => 'current_user_lists', 'uses' => 'ListController@current_user_lists']);

	Route::resource('tasks', 'TaskController');

	Route::resource('session', 'SessionController', array('except' => array('create', 'edit', 'update', 'show', 'index')));

	Route::patch('/sort-tasks', array(
		'as' => 'tasks.sort',
		'uses' => 'TaskController@sortTask'
	));

});





