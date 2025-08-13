<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$role)
    {
        // dd($role);
        if (in_array(Auth::user()->role,$role)) {
          return $next($request);
        }

        if ($request->ajax()) {
          return response('Unauthorized',501);
        }
        return redirect('/');
    }
}
