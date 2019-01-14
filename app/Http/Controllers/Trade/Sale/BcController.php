<?php

namespace App\Http\Controllers\Trade\Sale;

use App\Product;
use App\Purchased;
use App\Sale;
use App\Sale_bc;
use App\Sale_order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BcController extends Controller
{
    private $ht = 0;
    private $tva = 0;
    private $ttc = 0;
    private $tva_payed = 0;
    private $profit = 0;
    private $taxes = 0;
    private $profit_after_taxes = 0;

    public function create(Sale $sale)
    {
        $this->authorize('view',$sale);
        return view('trade.sale.bc.bc-create',compact('sale'));
    }

    public function products(Request $request,Sale $sale)
    {
        $this->authorize('view',$sale);
        // trouvez les produits de purchased qui son disponible
        $company = auth()->user()->member->company;
        $purchaseds = DB::table('purchaseds')
            ->join('products', 'products.id', '=', 'purchaseds.product_id')
            ->join('buy_orders', 'buy_orders.id', '=', 'purchaseds.buy_order_id')
            ->where('purchaseds.store_qt','>',0)
            ->select('purchaseds.id as purchased_id', 'purchaseds.*', 'products.*', 'products.id as product_id','buy_orders.pu as order_pu')
            ->where('products.name','LIKE','%'.$request->product.'%')
            ->where('products.company_id','=',$company->id)
            ->get();
       // dd($purchaseds[0]->purchased_id);
        return view('trade.sale.bc.list-product',compact('purchaseds','sale'));
    }

    public function store(Request $request, Sale $sale)
    {
        // new order
        $purchased = Purchased::where('id',$request->purchased_id)->first();
        if($purchased->offer_qt < $request->qt){
            session()->flash('danger',__('pages.trade.sale.bc.qt_danger'));
            return back();
        }
        // new bc
        $bc = $sale->bcs()->create($request->all(['qt','purchased_id']));
        // update purchased offer
        $purchased->update(['offer_qt' => $purchased->offer_qt - $request->qt]);
        // pu qt ht tva ttc tva_payed profit taxes profit_after_taxes
        $product_tva = $purchased->product->tva;
        $pu = $request->pu;
        $qt = $request->qt;
        $ht = $pu * $qt;
        $tva = ($ht * $product_tva ) /100;
        $ttc = $ht + $tva;
        $tva_prev = $purchased->buy_order->tva / $purchased->buy_order->bc->qt;
        $tva_payed = (($tva/$qt) - $tva_prev) * $qt;
        //dd($tva_payed);
        $profit = ($pu - ((int)$purchased->buy_order->ht / (int)$purchased->buy_order->bc->qt)) * $qt;
        $taxes = (int) auth()->user()->member->company->info_box->taxes;
        $taxes = ($taxes * $profit ) / 100;
        $profit_after_taxes = $profit - $taxes;
        //dd($pu);
        $sale->dv->orders()->create([
            'pu'                    => $pu,
            'ht'                    => $ht,
            'tva'                   => $tva,
            'ttc'                   => $ttc,
            'tva_payed'             => $tva_payed,
            'profit'                => $profit,
            'taxes'                 => $taxes,
            'profit_after_taxes'    => $profit_after_taxes,
            'sale_dv_id'            => $sale->dv->id,
            'sale_bc_id'            => $bc->id
        ]);
        // update sale prince
        $this->orders($sale);
        $sale->update([
            'ht'                    => $this->ht,
            'tva'                   => $this->tva,
            'ttc'                   => $this->ttc,
            'tva_payed'             => $this->tva_payed,
            'profit'                => $this->profit,
            'taxes'                 => $this->taxes,
            'profit_after_taxes'    => $this->profit_after_taxes
        ]);
        return back();
    }

    private function orders(Sale $sale)
    {
        foreach ($sale->dv->orders as $order){
            $this->ht += $order->ht;
            $this->tva += $order->tva;
            $this->ttc += $order->ttc;
            $this->tva_payed += $order->tva_payed;
            $this->profit += $order->profit;
            $this->taxes += $order->taxes;
            $this->profit_after_taxes += $order->profit_after_taxes;
        }
    }

    public function destroy(Sale $sale, int $order)
    {
        $order = Sale_order::findOrFail($order);
        $purchased = $order->bc->purchased;
        $purchased->update([
            'offer_qt' => $purchased->offer_qt + $order->bc->qt
        ]);
        $order->bc()->delete();
        $order->delete();
        $this->orders($sale);
        $sale->update([
            'ht'                    => $this->ht,
            'tva'                   => $this->tva,
            'ttc'                   => $this->ttc,
            'tva_payed'             => $this->tva_payed,
            'profit'                => $this->profit,
            'taxes'                 => $this->taxes,
            'profit_after_taxes'    => $this->profit_after_taxes
        ]);
        return back();
    }

    public function confirm(Sale $sale, Sale_bc $sale_bc)
    {
        $sale->trade_action()->update([
            'dv'            => true,
            'dv_member_id'  => auth()->user()->member->id,
            'dv_time'       => Carbon::now(),
            'tasks'         => json_encode(['prev' => null,'next' => ['name' => 'vendre','url'=> route('sale.show',compact('sale')) . '/tasks/done'],'progress' => 30]),

        ]);
        return redirect()->route('sale.show',compact('sale'));
    }

    public function productsRelease(Sale $sale, int $id)
    {
        $purchased = Purchased::findOrFail($id);
        $bcs = $purchased->sale_bcs;
        $bcs = collect($bcs)->reject(function ($bc) {
            return $bc->sale->trade_action->dv;
        });
        return view('trade.sale.release',compact('bcs'));
    }
}
