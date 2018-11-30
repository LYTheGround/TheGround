<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Sale;
use App\Trade_action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        $company = auth()->user()->member->company;
        $sales = Sale::where('company_id',$company->id)->with(['trade_action'])->get();
        return view('trade.sale.index',compact('sales'));
    }

    public function store(Request $request)
    {
        // new trade action
        $tasks = json_encode(['next' => null,'progress' => 0]);
        $trade = Trade_action::create([
            'status' => 'int',
            'tasks' => $tasks
        ]);
        // new sale
        $sale = $trade->sale()->create([
            'company_id' => auth()->user()->member->company->id
        ]);
        $sale->update(['slug' => 'S-'.$sale->id]);
        return redirect()->route('bc.create',compact('buy'));
    }

    public function show(Sale $sale)
    {
        //
    }
}
