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
            'company_id' => auth()->user()->member->company->id,
            'user_id' => auth()->user()->id
        ]);
        $buy->update(['slug' => 'B-'.$buy->id]);

        return redirect()->route('bc.create',compact('buy'));
    }

    public function show(Buy $buy)
    {
        $this->authorize('view',$buy);
        $tasks = json_decode($buy->trade_action->tasks);
        return view('trade.buy.show',compact('buy','tasks'));
    }

    public function destroy(Request $request, Buy $buy)
    {
        $this->authorize('delete',$buy);
        if(isset($buy->dvs[0])){
            foreach ($buy->dvs as $dv){
                if(isset($dv->orders[0])){
                    foreach ($dv->orders as $order){
                        $order->delete();
                    }
                }
                $dv->delete();
            }
        }
        if(isset($buy->bcs[0])){
            foreach ($buy->bcs as $bc){
                $bc->delete();
            }
        }
        $buy->trade_action()->delete();
        $buy->delete();
        session()->flash('status',__('pages.trade.buy.delete.success'));
        return redirect()->route('buy.index');
    }
}
