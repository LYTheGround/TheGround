<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Trade_action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyController extends Controller
{
    public function index()
    {
        $company = auth()->user()->member->company;
        $buys = Buy::where('company_id',$company->id)->with(['trade_action'])->get();
        return view('trade.buy.index',compact('buys'));
    }

    public function store(Request $request)
    {
        // new trade_action
        $tasks = json_encode(['next' => null,'progress' => 0]);
        $trade = Trade_action::create([
            'status' => 'int',
            'tasks' => $tasks
        ]);
        // new buy
        $buy = $trade->buy()->create([
            'company_id' => auth()->user()->member->company->id
        ]);
        $buy->update(['slug' => 'B-'.$buy->id]);

        return redirect()->route('bc.create',compact('buy'));
    }

    public function show(Buy $buy,TradeActionController $tradeActionController)
    {
        $tasks = json_decode($buy->trade_action->tasks);
        return view('trade.buy.show',compact('buy','tasks'));
    }
}
