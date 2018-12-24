<?php

namespace App\Http\Controllers\Admin;

use App\Accounting;
use App\Admin;
use App\Company;
use App\Http\Requests\Company\TaxesRequest;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Sold;
use Illuminate\Support\Facades\DB;

class TaxesController extends Controller
{
    private $is;
    private $profit = 0;
    private $taxes = 0;

    public function editTaxes(Company $company)
    {
        $this->authorize('view',Admin::class);
        return view('admin.company.taxes', compact('company'));
    }

    public function updateTaxes(TaxesRequest $request,Company $company)
    {
        $this->authorize('view',Admin::class);
        $this->is = $request->taxes;
        $company->info_box()->update([
            'taxes' => $request->taxes
            ]);
        $this->cleanMonths($company);
        $sales = $company->sales()->with('dv.orders')->get();
        $this->sales($sales);
        $this->unloads($company);


        return redirect()->route('company.show',compact('company'));
    }

    /**
     * modifier les calcules des ventes en taxes et profit et profit_after_taxes
     *
     * @param $sales
     */
    private function sales($sales)
    {
        foreach ($sales as $sale){
            $taxes = ($sale->profit * $this->is) / 100;
            $profitAfterTaxes = $sale->profit - $taxes;
            $sale->update([
                'taxes' => $taxes,
                'profit_after_taxes' => $profitAfterTaxes
            ]);
            $this->profit .= $profitAfterTaxes;
            $this->taxes .= $taxes;
            $this->orders($sale);
            $this->month($sale);
        }
    }

    /**
     * updates orders on taxes and profit_after_taxes
     *
     * @param Sale $sale
     */
    private function orders(Sale $sale)
    {
        foreach ($sale->dv->orders as $order){
            $taxes = ($order->profit * $this->is) / 100;
            $profitAfterTaxes = $order->profit - $taxes;
            $order->update([
                'taxes' => $taxes,
                'profit_after_taxes' => $profitAfterTaxes
            ]);
        }
    }

    /**
     * mise a zero tous les months en accounting et taxes_after_unload
     * en prenant en compte tous les unload
     * retiré aussi les taxes depuis le accounting table en
     * @param Company $company
     *
     * @return mixed
     */
    private function cleanMonths(Company $company)
    {
        $accounting = $company->accounting;
        $months =  $accounting->months()
            ->whereRaw('YEAR(date) = ' . gmdate('Y'))
            ->get();
        foreach ($months as $month){
            $month->update([
                'taxes' => 0,
                'profit' => 0,
                'taxes_after_unload' => 0
            ]);
        }
        $accounting->update([
            'profit' => 0,
            'taxes'     => 0,
            'taxes_after_unload' => 0
        ]);
        return $accounting;
    }

    private function month($sale)
    {
        $month = $sale->dv->orders[0]->sold->month;

        $month->update([
            'taxes'     => $month->taxes + $sale->taxes,
            'profit'    => $month->profit + $sale->profit_after_taxes,
            'taxes_after_unload'    => $month->taxes_after_unload + $sale->taxes,
        ]);
        $accounting = $month->accounting;

        $accounting->update([
            'taxes'     => $accounting->taxes + $sale->taxes,
            'profit'    => $accounting->profit + $sale->profit_after_taxes,
            'taxes_after_unload'    => $accounting->taxes_after_unload + $sale->taxes,
        ]);
        return $accounting;
    }

    private function unloads(Company $company)
    {
        $accounting = Accounting::find($company->accounting->id);

        foreach ($accounting->unloads as $unload) {
            $accounting->update([
                'taxes_after_unload' => $accounting->taxes_after_unload - $unload->prince
            ]);
            $month = $unload->month;
            $month->update([
                'taxes_after_unload' => $month->taxes_after_unload - $unload->prince
            ]);
        }
    }
}
