<?php

namespace App\Http\Middleware;

use Closure;

class ClientOnly
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
        if(auth()->check() && auth()->user()->user_type==1)
            return $next($request);
        session()->flash('status','You have to be logged in as a customer');
        return redirect()->route('landing');
    }
}
