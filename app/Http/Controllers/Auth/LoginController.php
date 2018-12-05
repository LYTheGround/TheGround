<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $page = 'pages.auth.login.';
        return view('auth.login',compact('page'));
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if(isset($user->admin)){
            return redirect()->route('company.index');
        }
        $plan = new PlanController();
        // la vérification de la date limit et le status du compte
        $p = $plan->UserPlan(auth()->user());
        if($p){
            return redirect()->route('home');
        }
        // si non déconnecté le et affiché un message d'errure
        else{
            $this->guard()->logout();
            $request->session()->invalidate();
            return back()->withInput($request->only('email'));
        }
    }
}
