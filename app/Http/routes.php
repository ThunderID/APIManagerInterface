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

	Route::get('/logout',						['uses' => 'AuthController@getLogout', 'as' => 'auth.getLogout']);

	Route::group(['middleware' => 'expire.token'], function() 
	{
		Route::resource('/my/apps',						'AppController',		['names' => ['index' => 'apps.index', 'create' => 'apps.create', 'store' => 'apps.store', 'show' => 'apps.show', 'edit' => 'apps.edit', 'update' => 'apps.update', 'destroy' => 'apps.destroy']]);

		Route::resource('/my/app/{client_id?}/acls',	'AclController',		['names' => ['index' => 'acls.index', 'create' => 'acls.create', 'store' => 'acls.store', 'show' => 'acls.show', 'edit' => 'acls.edit', 'update' => 'acls.update', 'destroy' => 'acls.destroy']]);
		
		Route::get('/my/users',							['uses' => 'AclController@FindUserByName', 'as' => 'acls.get.user']);
	
		Route::get('/generate/key', 				['uses' => 'AppController@generateKey', 'as' => 'generate.key']);
		Route::get('/generate/secret', 			['uses' => 'AppController@generateSecret', 'as' => 'generate.secret']);
	});
});
