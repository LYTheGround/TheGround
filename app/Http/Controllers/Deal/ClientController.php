<?php

namespace App\Http\Controllers\Deal;

use App\City;
use App\Client;
use App\Http\Requests\Deal\DealRequest;
use App\Info_box;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        $clients = auth()->user()->member->company->clients;
        return view('deal.client.index',compact('clients'));
    }

    public function create()
    {
        $cities = City::all();
        return view('deal.client.create',compact('cities'));
    }

    public function store(DealRequest $request)
    {
        $data = $request->all();
        $data['city_id'] = $request->city;
        $info_box = Info_box::create($data);
        //  slug
        $slug = str_slug(request()->name . ' ' . $info_box->id, '-');
        // description - company - user
        $client = $info_box->client()->create([
            'slug' => $slug,
            'description' => $request->description,
            'company_id' => auth()->user()->member->company_id,
            'user_id'   => auth()->user()->id
        ]);
        // tel
        $info_box->tels()->create(['tel' => $request->tel, 'default' => true]);
        // email
        $info_box->emails()->create(['email' => $request->email, 'default' => true]);
        session()->flash('status', __('pages.deal.client.create.success'));
        return redirect()->route('client.show', compact('client'));
    }

    public function show(Client $client)
    {
        $this->authorize('view',$client);
        return view('deal.client.show',compact('client'));
    }

    public function edit(Client $client)
    {
        $this->authorize('update',$client);
        $cities = City::all();
        return view('deal.client.edit',compact('client','cities'));
    }

    public function update(DealRequest $request, Client $client)
    {
        $this->authorize('update',$client);
        $data = $request->all();
        $data['city_id'] = $request->city;
        $client->update(['description' => $request->description]);
        $client->info_box->update($data);
        $client->info_box->emails[0]->update(['email' => $request->email]);
        $client->info_box->tels[0]->update(['tel' => $request->tel]);
        session()->flash('status', __('pages.deal.client.edit.success'));
        return redirect()->route('client.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        if(auth()->user()->can('delete',$client)){
            $client->info_box->emails()->delete();
            $client->info_box->tels()->delete();
            $client->info_box->delete();
            $client->delete();
            session()->flash('status', __('pages.client.delete_success'));
            return redirect()->route('client.index');
        }
        session()->flash('danger', __('pages.deal.client.delete.danger'));
        return back();
    }
}
