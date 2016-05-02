<?php 
namespace App\Http\Controllers;

class AuthController extends Controller
{
	protected $view_name 		= 'Authorize';
	
	public function getLogin()
	{
		return view('content.login.form')
			->with('login', true);
	}
}
