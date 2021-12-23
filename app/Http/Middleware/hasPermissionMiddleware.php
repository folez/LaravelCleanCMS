<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hasPermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $route = null)
    {
        if(!class_exists(\Spatie\Permission\PermissionServiceProvider::class)){
            $user = $request->user();

            if(!$user)
                return redirect()->route('admin.login');

            return $next( $request );
        }
        if (app('auth')->guard()->guest()) {
            return redirect()->route($route);
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (app('auth')->guard()->user()->can($permission)) {
                return $next($request);
            }
        }

        return redirect()->route($route);
    }
}
