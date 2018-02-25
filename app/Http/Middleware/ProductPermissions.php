<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ProductPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = Auth::user();
        
        if ($request->is('adminz/products/create')) {
            if (!$auth->hasPermissionTo('CREATE_PRODUCT')) {
                abort(401, "No permissions");
            }
        }
            
        if ($request->is('adminz/products/*/edit')) {
            if (!$auth->hasPermissionTo('UPDATE_PRODUCT')) {
                abort(401, "No permissions");
            }
        }
        
        if ($request->isMethod('Delete')) {
            if (!$auth->hasPermissionTo('DELETE_PRODUCT')) {
                abort(401, "No permissions");
            }
        }
        
        return $next($request);
    }
}
