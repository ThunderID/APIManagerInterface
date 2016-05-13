<?php

namespace ThunderID\APIHelper\Middleware;

use Carbon\Carbon;
use Closure, Session, Redirect;

use ThunderID\APIHelper\API\APIAuth;
use Illuminate\Support\Facades\App;

/**
 * Class middleware of access expire token
 *
 * @author cmooy
 */
class ExpireTokenMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 *
	 * @throws App
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if(Session::get('expired_at') <= Carbon::now()->format('Y-m-d H:i:s'))
		{
			$credentials['access_token']	= Session::get('access_token');
			$credentials['refresh_token']	= Session::get('refresh_token');
			$credentials['grant_type']		= 'refresh_token';
			$credentials['HTTP_HOST']		= env('OAUTH_HOST', 'apimanager');

			$APIAuth						= new APIAuth;

			$result							= $APIAuth->loggedIn($credentials);

			if($result['status'] != 'success')
			{
				Redirect::route(env('ROUTE_LOGIN', 'auth.login.get'))->send();
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
		}

		return $next($request);
	}
}
