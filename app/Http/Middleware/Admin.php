<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Filter the admins and redirect them to their space area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset(auth()->user()->admin)){
            return redirect()->route('admin.index');
        }
        return $next($request);
    }
}
