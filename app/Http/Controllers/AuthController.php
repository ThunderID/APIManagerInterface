<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\API\Connectors\APIAuth;
use Input, Session, Route;

class AuthController extends BaseController
{
	//init 
	protected $view_source_root	= 'content.login';
	protected $page_title		= 'Login';
	protected $breadcrumb		= [];
	
	public function getLogin()
	{
		//page attributes
		$this->page_attributes->page_title	= $this->page_title;

		//generate view
		$view_source                       = $this->view_source_root.'.form';
		$route_source                      = route(Route::CurrentRouteName());

		return $this->generateView($view_source, $route_source);
	}

	public function postLogin()
	{
		$credentials 					= Input::only('username', 'password');

		$credentials['key']				= env('OAUTH_KEY', 'localhost');
		$credentials['secret']			= env('OAUTH_SECRET', 'localhost');
		$credentials['HTTP_HOST']		= env('OAUTH_HOST', 'apimanager');
		$credentials['grant_type']		= 'owned';

		$APIAuth						= new APIAuth;

		$result							= $APIAuth->loggedIn($credentials);

		if($result['status'] != 'success')
		{
			$this->errors                           = $result['message'];
		}
		else
		{
			Session::put('access_token', $result['data']['access_token']);
			Session::put('refresh_token', $result['data']['refresh_token']);
			Session::put('expired_at', $result['data']['expired_at']);

			if(isset($result['data']['whoami']))
			{
				Session::put('whoami', $result['data']['whoami']);
			}
		}

		$this->page_attributes->msg		= "Login Sukses";

		return $this->generateRedirectRoute('apps.index');        
	}
}
