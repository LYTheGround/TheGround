<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\City;
use App\Company;
use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * la liste des administrateurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.admin.index',['admins' => Admin::with('user')->get()]);

    }

    /**
     * Le formulaire de la création d'un nouveau administrateur.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.admin.create',['cities' => City::all()]);

    }

    /**
     * @param AdminCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {
        return redirect()->route('admin.show',[
            'admin' =>  User::create([
                'login' => $request->login,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->admin()->create([
                'type' => 'B',
                'city_id' => $request->city
            ])
        ]);
    }

    /**
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {

        return view('admin.admin.show',compact('admin'));

    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        return view('admin.admin.edit');

    }

    /**
     * @param AdminUpdateRequest $request
     * @param  \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $admin->user->email = $request->email;
        $admin->user->login = $request->login;
        if($request->password){
            $admin->user->password = Hash::make($request->password);
        }
        $admin->user->save();
        return redirect()->route('admin.show',compact('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if($admin->type != 'A'){
            $company = Company::where('user_id',$admin->user->id)->first();
            if(!$company){
                if(auth()->user()->admin->type == 'A'){
                    session()->flash('success', 'l\administrateur a bien été supprimé');
                    $admin->user()->delete();
                    $admin->delete();
                }
                else{
                    session()->flash('danger', 'vous avez pas l\autorisation nécessaire');
                }
            }
            else{
                session()->flash('danger', 'ce member a créer déjà une ou des compagnies');
            }
        }
        else{
            session()->flash('danger', 'Je ne peux pas supprimé mon propriétaire :(');
        }
        return redirect()->route('admin.index');
    }
}
