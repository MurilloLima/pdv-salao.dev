<?php

namespace App\Http\Middleware;

use Closure;

class CheckMiddleware
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
        if (Auth()->user()->role != 'admin')
            return redirect()->to('errors/restrito/');
            
        return $next($request);
    }
}
