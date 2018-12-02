<?php

namespace App\Http\Controllers\Money;

use App\Month;
use App\Unload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnloadController extends Controller
{
    public function index()
    {
        $month = Month::month();
        $unloads = $month->unloads;
        view('money.unload.index',compact('unloads','month'));
    }

    public function create()
    {
        return view('money.unload.create');
    }

    public function store(Request $request)
    {
        if($request->charge == 'tva'){
            $tva = true;
            $taxes = false;
        }
        else{
            $tva = false;
            $taxes = true;
        }
        $month = Month::month();
        $month->unloads()->create([
            'prince'    => $request->prince,
            'tva'       => $tva,
            'taxes'     => $taxes,
            'justify'   => $request->file('justify')->store('unload'),
            'accounting_id' => $month->accounting_id
        ]);
        if($request->charge == 'tva'){
            $month->update([
                'tva_after_unload' => $month->tva_after_unload - $request->prince,
            ]);
        }
        else{
            $month->update([
                'taxes_after_unload' => $month->taxes_after_unload - $request->prince,
            ]);
        }
        return redirect()->route('accounting.show',compact('month'));
    }

    public function show(Unload $unload)
    {
        return view('money.unload.show',compact('unload'));
    }

    public function destroy()
    {
        // todo: destroy unload
    }
}
