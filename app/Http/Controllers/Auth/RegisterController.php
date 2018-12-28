<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\Info;
use App\Premium;
use App\Token;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Rules\PasswordRule;
use App\Rules\TelRule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => 'required|string|min:2|max:20',
            'last_name'     => 'required|string|min:2|max:20',
            'tel'           => ['required','min:10','max:10',new TelRule(), 'unique:tels,tel'],
            'address'       => 'required|string|min:10|max:100',
            'city'          => 'bail|required|int|exists:cities,id',
            'birth'         => 'bail|nullable|date|before:' . date('d-m-Y',strtotime("-18 years")),
            'token'         => 'required|min:20|exists:tokens,token',
            'name'          => 'bail|required|string|max:25|unique:members',
            'email'         => 'required|string|email|max:80|unique:emails,email',
            'password'      => ['required','string','min:6','max:18','confirmed',new PasswordRule()],
            'cin'           => 'nullable|string|min:6,unique:infos,cin'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // user
        $user = User::create([
            'login' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // info
        $info = Info::create([
            'last_name'     => $data['last_name'],
            'first_name'    => $data['first_name'],
            'birth'         => $data['birth'],
            'address'       => $data['address'],
            'cin'           => $data['cin'],
            'city_id'       => $data['city']
        ]);
        // email
        $info->emails()->create(['email'  => $data['email'],'default'   =>  true]);
        // tel
        $info->tels()->create(['tel'  => $data['tel'],'default' =>  true]);
        // token
        $token = Token::where('token',$data['token'])->first();
        $range = (int) $token->range;
        // premium
        $premium = Premium::create([
            'limit'         => gmdate("Y-m-d",strtotime("+$range days")),
            'update_status' => gmdate('Y-m-d'),
            'category_id'   => $token->category_id,
            'status_id'     => 2
        ]);
        // members
        $member = $premium->member()->create([
            'name'      => $data['name'],
            'info_id'   => $info->id,
            'user_id'   => $user->id,
            'company_id'=> $token->company_id
        ]);
        $member->update(['slug'=> str_slug($data['name'] . '-' . $member->id)]);
        // activate company
        if($token->category->category == 'pdg'){
            $token->company->activate();
        }
        $token->delete();

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $page = 'pages.auth.register.';
        $cities = City::all();
        return view('auth.register',compact('page','cities'));
    }
}
