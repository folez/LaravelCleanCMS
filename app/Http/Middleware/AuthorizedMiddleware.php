<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizedMiddleware
{
	/**
	 * Handle an incoming request.
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 * @return mixed
	 */
	public function handle( $request, Closure $next )
	{
		$user = $request->user();

		if(!$user)
			return redirect()->route('admin.login');

		return $next( $request );
	}
}