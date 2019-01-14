<?php

namespace App\Http\Middleware;

use Closure;

class Member
{
    /**
     * Filter members and redirect them to their space area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset(auth()->user()->admin)){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
