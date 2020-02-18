<?php

namespace App\Http\Middleware;

use Closure;

class Pharma
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
        if (\Auth::user()->user_type == 'pharmacist' || \Auth::user()->user_type == 'admin' ) {
            return $next($request);
          }else{
            return redirect()->back();
          }
    }
}
