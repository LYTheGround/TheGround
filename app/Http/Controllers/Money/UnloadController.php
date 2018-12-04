<?php

namespace App\Http\Controllers\Money;

use App\Month;
use App\Unload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UnloadController extends Controller
{
    public function index()
    {
        $month = Month::month();
        $unloads = $month->unloads;
        return view('money.unload.index', compact('unloads', 'month'));
    }

    public function create()
    {
        return view('money.unload.create');
    }

    public function store(Request $request)
    {
        if ($request->charge == 'tva') {
            $tva = true;
            $taxes = false;
        }
        else {
            $tva = false;
            $taxes = true;
        }
        $month = Month::month();
        $unload = $month->unloads()->create([
            'name'  => $request->name,
            'prince' => $request->prince,
            'tva' => $tva,
            'taxes' => $taxes,
            'justify' => $request->file('justify')->store('unload'),
            'accounting_id' => $month->accounting_id,
            'month_id'  => $month->id,
            'member_id' => auth()->user()->member->id,
            'description' => $request->description
        ]);
        if ($request->charge == 'tva') {
            $month->update(['tva_after_unload' => $month->tva_after_unload - $request->prince,]);
            $month->accounting->update(['tva_after_unload' => $month->tva_after_unload - $request->prince,]);
        }
        else {
            $month->update(['taxes_after_unload' => $month->taxes_after_unload - $request->prince,]);
            $month->accounting->update(['taxes_after_unload' => $month->taxes_after_unload - $request->prince,]);
        }
        return redirect()->route('unload.show', compact('unload'));
    }

    public function show(Unload $unload)
    {
        return view('money.unload.show', compact('unload'));
    }

    public function edit(Unload $unload)
    {
        return view('money.unload.edit',compact('unload'));
    }

    public function update(Request $request, Unload $unload)
    {
        $data = $request->all();
        if($request->file('justify')){
            Storage::disk('public')->delete($unload->justify);
            $justify = $request->justify->store('unload/justify');
            $data['justify'] = $justify;
        }
        $unload->unload();
        $unload->charge($data);
        return redirect()->route('unload.show',compact('unload'));
    }

    public function destroy(Unload $unload)
    {
        $unload->unload();
        Storage::disk('public')->delete($unload->justify);
        $unload->delete();
        session()->flash('success','unload destroyed successfully');
        return redirect()->route('unload.index');
    }
}
