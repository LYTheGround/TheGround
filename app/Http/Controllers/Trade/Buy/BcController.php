<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Buy_bc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BcController extends Controller
{
    public function create(Buy $buy)
    {
        return view('trade.buy.bc.create',compact('buy'));
    }

    public function products(Request $request,Buy $buy)
    {
        $products = auth()->user()->member->company->products()->where('name','LIKE','%' . $request->product . '%')->get();
        return view('trade.buy.bc.list',compact('products','buy'));
    }

    public function store(Request $request,Buy $buy)
    {
        $buy->bcs()->create([
            'qt' => $request->qt,
            'product_id' => $request->product
        ]);
        return back();
    }

    public function destroy(Buy $buy, Buy_bc $bc)
    {
        $bc->delete();
        return back();
    }

    /**
     * Confirm bc
     * @param Buy $buy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm(Buy $buy)
    {
        $buy->trade_action->update([
            'bc'            => true,
            'bc_member_id'  => auth()->user()->member->id,
            'bc_time'       => Carbon::now(),
            'tasks'         => json_encode(['prev' => null,'next' => null,'progress' => 15]),
        ]);
        return redirect()->route('buy.show',compact('buy'));
    }
}
