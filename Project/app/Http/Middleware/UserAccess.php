<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if ($userType == 'admin') {
            $role = 1;
        } elseif ($userType == 'user') {
            $role = 0;
        } elseif ($userType == 'stock') {
            $role = 2;
        }elseif($userType == 'loguser'){
            return $next($request);
        }
        
        if (auth()->user()->is_active == 1) {
            if (auth()->user()->is_admin == $role) {
                return $next($request);
            }

            return response()->json(['You do not have permission to access for this page.' ]);
        } elseif (auth()->user()->is_active == 0) {
            return response()->json(['Your Accout is Deactivated. Please Contact Admin']);
        }
    }
}
