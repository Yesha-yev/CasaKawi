<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role)
    {
        $user = Auth::user();
        if (!$user){
            return redirect()->route('login');
        }
        $roles=is_string($role)?explode('|',$role):(array)$role;

        if (!in_array($user->role,$roles)){
            abort(403,'Unauthorized action');
        }
        return $next($request);
    }
}
