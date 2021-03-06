<?php

namespace App\Http\Controllers\Trade\Buy;

use App\Buy;
use App\Buy_bc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BcController extends Controller
{
    public function create(Buy $buy)
    {
        $this->authorize('bc',$buy);
        return view('trade.buy.bc.create',compact('buy'));
    }

    public function products(Request $request,Buy $buy)
    {
        $this->authorize('bc',$buy);
        $products = auth()->user()->member->company->products()->where('name','LIKE','%' . $request->product . '%')->get();
        //dd($products[0]->imgs[0]->img);
        return view('trade.buy.bc.list',compact('products','buy'));
    }

    public function store(Request $request,Buy $buy)
    {
        $this->authorize('bc',$buy);
        $validate = Validator::make($request->all(),[
            'qt'            => 'required|int|min:1',
            'product'    => 'required|int|exists:products,id'
        ]);
        if($validate->fails()){
            foreach ($validate->errors()->messages() as $message){
                session()->flash('danger',$message[0]);
            }
            return back();
        }
        $buy->bcs()->create([
            'qt' => $request->qt,
            'product_id' => $request->product
        ]);
        return back();
    }

    public function destroy(Buy $buy, Buy_bc $bc)
    {
        $this->authorize('bc',$buy);
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
        return redirect()->route('dv.create',compact('buy'));
    }
}
