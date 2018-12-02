<?php

namespace App\Http\Controllers\Deal;

use App\City;
use App\Info_box;
use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = auth()->user()->member->company->providers;
        return view('deal.provider.index',compact('providers'));
    }

    public function create()
    {
        $cities = City::all();
        return view('deal.provider.create',compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(request(),[
            'name'=>'unique:info_boxes',
            'licence'=>'',
            'turnover'=>'',
            'taxes'=>'',
            'fax'=>'unique:info_boxes',
            'speaker'=>'',
            'build'=>'',
            'address'=>'',
            'floor'=>'',
            'apt_nbr'=>'',
            'zip'=>'',
            'city_id'=>'',

        ]);

        if($info_box = Info_box::create($data)){
            $datap = $this->validate(request(),['description'=>'']);
            $datam = $this->validate(request(),['email'=>'unique:emails']);
            $datat = $this->validate(request(),['tel'=>'unique:tels']);
            $datap['slug'] = str_slug(request()->name . ' ' .$info_box->id, '-');
            $datap['company_id'] = auth()->user()->member->company->id;
            $info_box->emails()->create($datam);
            $info_box->tels()->create($datat);
            $provider = $info_box->provider()->create($datap);
            session()->flash('status',__('pages.provider.add_success'));
            return redirect()->route('provider.show',compact('provider'));
        }

    }

    public function show(Provider $provider)
    {
        return view('deal.provider.show',compact('provider'));
    }

    public function edit(Provider $provider)
    {
        $cities = City::all();
        return view('deal.provider.edit',compact('provider','cities'));
    }

    public function update(Request $request, Provider $provider)
    {
        $data = $this->validate(request(),[
            'brand'=>'unique:info_boxes,brand,'.$provider->info_box_id,
            'name'=>'unique:info_boxes,name,'.$provider->info_box_id,
            'licence'=>'',
            'turnover'=>'',
            'taxes'=>'',
            'fax'=>'unique:info_boxes,fax,'.$provider->info_box_id,
            'speaker'=>'',
            'build'=>'',
            'address'=>'',
            'floor'=>'',
            'apt_nbr'=>'',
            'zip'=>'',
            'city_id'=>'',

        ]);

        if($info_box = $provider->info_box->update($data)){
            $datap = $this->validate(request(),['description'=>'']);
            $datap['slug'] = str_slug(request()->name . ' ' .$provider->info_box->name, '-');
            $datap['company_id'] = auth()->user()->member->company->id;




            if(isset($provider->info_box->emails[0]->id)){
                $datam = $this->validate(request(),['email'=>'unique:emails,email,'.$provider->info_box->emails[0]->id]);
                $provider->info_box->emails()->update($datam);
            }else{
                if(request()->email){
                    $datam = $this->validate(request(),['email'=>'']);
                    $provider->info_box->emails()->create($datam);
                }
            }
            if(isset($provider->info_box->tels[0]->id)){
                $datat = $this->validate(request(),['tel'=>'unique:tels,tel,'.$provider->info_box->tels[0]->id]);
                $provider->info_box->tels()->update($datat);
            }else{
                if(request()->tel){
                    $datat = $this->validate(request(),['tel'=>'']);
                    $provider->info_box->tels()->create($datat);
                }

            }

            $provider->update($datap);
            session()->flash('status',__('pages.provider.update_success'));
            return redirect()->route('provider.show',compact('provider'));
        }
    }

    public function destroy(Provider $provider)
    {
        $provider->info_box->emails()->delete();
        $provider->info_box->tels()->delete();
        $provider->info_box->delete();
        $provider->delete();
        session()->flash('status',__('pages.provider.delete_success'));
        return redirect()->route('provider.index');
    }
}
