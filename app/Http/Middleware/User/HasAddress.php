<?php

namespace App\Http\Middleware\User;

use Closure;

class HasAddress
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
        if (!$request->user()->hasAddress()) {
            alert()->warning('Add address first before purchase')->persistent('Ok');

            return redirect()->route('address.index');
        }

        return $next($request);
    }
}
