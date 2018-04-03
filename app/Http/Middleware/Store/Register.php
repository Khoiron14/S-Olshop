<?php

namespace App\Http\Middleware\Store;

use Closure;

class Register
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
        if (!$request->user()->hasRole('user') || $request->user()->hasRole('seller')) {
            return redirect()->back();
        }

        return $next($request);
    }
}
