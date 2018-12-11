<?php

namespace App\Http\Controllers\Deal;

use App\City;
use App\Http\Requests\Deal\DealRequest;
use App\Info_box;
use App\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = auth()->user()->member->company->providers;
        return view('deal.provider.index', compact('providers'));
    }

    public function create()
    {
        $cities = City::all();
        return view('deal.provider.create', compact('cities'));
    }

    public function store(DealRequest $request)
    {
        $data = $request->all();
        $data['city_id'] = $request->city;
        $info_box = Info_box::create($data);
        //  slug
        $slug = str_slug(request()->name . ' ' . $info_box->id, '-');
        // description - company - user
        $provider = $info_box->provider()->create([
            'slug' => $slug,
            'description' => $request->description,
            'company_id' => auth()->user()->member->company_id,
            'user_id'   => auth()->user()->id
        ]);
        // tel
        $info_box->tels()->create(['tel' => $request->tel, 'default' => true]);
        // email
        $info_box->emails()->create(['email' => $request->email, 'default' => true]);
        session()->flash('status', __('pages.deal.provider.create.success'));
        return redirect()->route('provider.show', compact('provider'));
    }

    public function show(Provider $provider)
    {
        $this->authorize('view',$provider);
        return view('deal.provider.show', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        $this->authorize('update',$provider);
        $cities = City::all();
        return view('deal.provider.edit', compact('provider', 'cities'));
    }

    public function update(DealRequest $request, Provider $provider)
    {
        $this->authorize('update',$provider);
        $data = $request->all();
        $data['city_id'] = $request->city;
        $provider->update(['description' => $request->description]);
        $provider->info_box->update($data);
        $provider->info_box->emails[0]->update(['email' => $request->email]);
        $provider->info_box->tels[0]->update(['tel' => $request->tel]);
        session()->flash('status', __('pages.deal.provider.edit.success'));
        return redirect()->route('provider.show', compact('provider'));
    }

    public function destroy(Provider $provider)
    {
        if(auth()->user()->can('delete',$provider)){
            $provider->info_box->emails()->delete();
            $provider->info_box->tels()->delete();
            $provider->info_box->delete();
            $provider->delete();
            session()->flash('status', __('pages.provider.delete_success'));
            return redirect()->route('provider.index');
        }
        session()->flash('danger', __('pages.deal.provider.delete.danger'));
        return back();
    }
}
