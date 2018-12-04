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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.admin.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreateRequest $request)
    {
        //dd($request);
        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $admin = $user->admin()->create([
            'type' => 'B',
            'city_id' => $request->city
        ]);
        return redirect()->route('admin.show',compact('admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $companies = Company::where('user_id',$admin->user->id)->get();
        return view('admin.admin.show',compact('admin','companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $cities = City::all();
        return view('admin.admin.edit',compact('admin','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
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
            if(auth()->user()->admin->type == 'A'){
                $admin->delete();
            }
        }
        return redirect()->route('admin.index');
    }
}
