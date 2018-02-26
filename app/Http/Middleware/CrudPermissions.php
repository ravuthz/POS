<?php

namespace App\Http\Middleware;

use Log;
use Auth;
use Closure;

class CrudPermissions
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
        $permission = $this->fetchPermission($request);
        
        if (!$auth->hasPermissionTo($permission)) {
            Log::debug("User " . $auth->id . " can't " . $permission);
            abort(401, "Acess Denided");
        }
        
        Log::debug("User " . $auth->id . " can " . $permission);
        return $next($request);
    }
    
    protected function replaceAction($action) {
        switch ($action) {
            case 'index':
            case 'show':
                return 'detail_';
                
            case 'create':
            case 'store':
                return 'create_';
            
            case 'edit':
            case 'update':
                return 'update_';
                
            case 'destroy':
            case 'delete':
                return 'delete_';
        }
    }
    
    protected function fetchPermission($request) {
        $controller = class_basename($request->route()->getController());
        $controller = str_replace('Controller', '', $controller);
        $action = $request->route()->getActionMethod();
        $action = $this->replaceAction($action);
        return strtoupper($action . $controller);
    }
}
