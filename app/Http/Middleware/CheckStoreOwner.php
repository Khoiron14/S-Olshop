<?php

namespace App\Http\Middleware;

use Closure;

class CheckStoreOwner
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
        if ($request->store->user != auth()->user()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
