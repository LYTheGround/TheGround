<?php

namespace App\Http\Controllers\Money;

use App\Accounting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    private $month = ['december'];
    public function index()
    {


        $date = new \DateTime('2018-11-2');
        $m = $date->format('m');
        $n = gmdate('m');
        dd($m);
    }

    private function accountings()
    {
        $accounting = auth()->user()->member->company->accounting;
        return $this->solds($accounting,12);
    }

    private function solds(Accounting $accounting,int $month)
    {
        return DB::table('accountings')
            ->where('accountings.id', '=', $accounting->id)
            ->join('solds','solds.accounting_id','accountings.id')
            ->join('sale_orders','solds.sale_order_id','sale_orders.id')
            //->join('purchaseds','purchaseds.accounting_id','accountings.id')
            ->selectRaw("sum(sale_orders.tva_payed) as tva,sum(sale_orders.taxes) as taxes")
            ->get();
    }
}
