<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\City;
use App\Company;
use App\Http\Requests\Company\CompanyRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Http\Requests\Company\SoldRequest;
use App\Http\Requests\Company\StatusRequest;
use App\Http\Requests\Company\TaxesRequest;
use App\Info_box;
use App\Member;
use App\Notifications\Company\CompanyUpdate;
use App\Premium;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }

    public function show(Company $company)
    {
        $token = $company->tokens()->where('category_id',2)->first();
        return view('admin.company.show',compact('company','token'));
    }

    public function create()
    {
        $cities = City::all();
        return view('admin.company.create',compact('cities'));
    }

    public function store(CompanyRequest $request)
    {
        $brand = null;
        // brand
        if($request->brand){
            $brand = $request->brand->store('company/brand');
        }
        // info box
        $info_box = Info_box::create([
            'brand'     => $brand,
            'name'      => $request->name,
            'licence'   => $request->licence,
            'turnover'  => $request->turnover,
            'taxes'     => $request->taxes,
            'fax'       => $request->fax,
            'speaker'   => $request->speaker,
            'address'   => $request->address,
            'build'     => $request->build,
            'floor'     => $request->floor,
            'apt_nbr'   => $request->apt_nbr,
            'zip'       => $request->zip,
            'city_id'   => $request->city,
        ]);
        // email
        $info_box->emails()->create([
            'email'     => $request->email,
            'default'   => 1
        ]);
        //tel
        $info_box->tels()->create([
            'tel'       => $request->tel,
            'default'   => 1
        ]);
        // premium
        $premium = Premium::create([
            'sold'          => 10,
            'range'         => 5,
            'limit'         => null,
            'category_id'   => 1,
            'status_id'     => 1
        ]);
        // company
        $company = $premium->company()->create([
            'slug'      => str_slug($request->name . ' ' . $info_box->id),
            'info_box_id'   => $info_box->id,
            'user_id'   => auth()->user()->id
        ]);
        // pdg
        $company->tokens()->create([
            'token'         => md5(sha1(rand())),
            'range'         => 5,
            'category_id'   => 2
        ]);
        $company->accounting()->create([
            'tva' => 0
        ]);
        return redirect()->route('company.show',compact('company'));
    }

    public function edit(Company $company)
    {
        $cities = City::all();
        return view('admin.company.edit',compact('company','cities'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $info_box = $company->info_box;
        $brand = $info_box->brand;
        // brand
        if($request->brand){
            if($brand){
                Storage::disk('public')->delete($info_box->brand);
            }
            $brand = $request->brand->store('company/brand');
        }
        // update
        $company->info_box()->update([
            'brand'     => $brand,
            'name'      => $request->name,
            'licence'   => $request->licence,
            'turnover'  => $request->turnover,
            'fax'       => $request->fax,
            'speaker'   => $request->speaker,
            'address'   => $request->address,
            'build'     => $request->build,
            'floor'     => $request->floor,
            'apt_nbr'   => $request->apt_nbr,
            'zip'       => $request->zip,
            'city_id'   => $request->city,
        ]);
        $data = [
            'img' => null,
            'name' => auth()->user()->name,
            'url' => route('company.show',compact('company')),
            'task' => 'vient de modifier ' . $company->info_box->name,
            'msg' => 'veuillez vérifié',
        ];
        $admin = Admin::where('type','A')->first()->user;
        Notification::send($admin,new CompanyUpdate($data));
        return redirect()->route('company.show',compact('company'));
    }


    public function sold(Company $company)
    {
        $this->authorize('view',Admin::class);
        return view('admin.company.sold',compact('company'));
    }

    public function updateSold(SoldRequest $request, Company $company)
    {
        $this->authorize('view',Admin::class);
        $premium = $company->premium;
        $premium->update(['sold' => $request->sold + $premium->sold]);
        return redirect()->route('company.show',compact('company'));
    }

    public function status(Company $company)
    {
        $this->authorize('view',Admin::class);
        return view('admin.company.status',compact('company'));
    }

    public function updateStatus(StatusRequest $request, Company $company)
    {
        $this->authorize('view',Admin::class);
        // active
        $premium = new Premium();
        $premium->updateStatus($request->status,$company);
        // inactive
        // archived
        return back();
    }


}
