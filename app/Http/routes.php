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


Route::group(['middleware' => 'web'], function() {

	Route::get('/login',						['uses' => 'AuthController@getLogin', 'as' => 'auth.getLogin']);
	
	Route::post('/logging',						['uses' => 'AuthController@postLogin', 'as' => 'auth.postLogin']);

	Route::get('/', function () {
	    return view('welcome');
	});

});
