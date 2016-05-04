<?php

namespace App\Http\Middleware;

use Closure;
use Input;

use Illuminate\Contracts\Auth\Guard;

class PasswordNeeded
{
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//1. Check input
		if(!Input::has('password'))
		{
			\App::abort(404);
		}

		return $next($request);
	}
}
