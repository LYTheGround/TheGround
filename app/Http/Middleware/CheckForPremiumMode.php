<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\PlanController;
use Closure;

class CheckForPremiumMode
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
        $plan = new PlanController();
        // la vérification de la date limit et le status du compte
        $p = $plan->UserPlan(auth()->user());
        if(!$p){
            auth()->logout();
            //session()->flash('danger', 'votre Compte n\'est pas activez. pour plus d\'info veuillez nous Contacté');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
