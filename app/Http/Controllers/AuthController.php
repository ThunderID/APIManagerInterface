<?php 
namespace App\Http\Controllers;

class AuthController extends Controller
{
	protected $view_name 		= 'Authorize';
	
	public function getLogin()
	{
		dd('login');
	}
}
