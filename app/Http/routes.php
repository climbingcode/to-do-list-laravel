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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/about', 'AboutController@index');

Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);

Route::post('contact', ['as' => 'contact_store', 'uses' => 'AboutController@store']);

Route::resource('lists', 'ListController');

Route::resource('tasks', 'TaskController');

Route::resource('registration', 'RegistrationController');

Route::patch('/sort-tasks', array(
	'as' => 'tasks.sort',
	'uses' => 'TaskController@sortTask'
));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegistrationController@confirm'
]);

Route::filter('auth', function() {
	if (Auth::guest()) return Redirect::guest(URL::route('/sign-out'));
});

