<?php

namespace App\Http\Controllers\Money;

use App\Accounting;
use App\Month;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{

    public function index()
    {
        $this->authorize('view',Accounting::class);
        $accounting = auth()->user()->member->company->accounting;
        //$months = $accounting->months->orderBy('date', 'desc')->get();
        $months = Month::where('accounting_id',$accounting->id)->orderBy('date', 'desc')->get();
        return view('money.accounting.index',compact('accounting','months'));
    }

    public function show(Month $month)
    {
        $this->authorize('view',Accounting::class);
        // purchased
       $purchaseds =  $month->purchaseds;
        //dd($purchaseds);
        // solds
        $sales = $month->sales;
        $s = "WPj8G4D..7o0rt";
        // unloads
        $unloads = $month->unloads;
        return view('money.accounting.show',compact('sales','purchaseds','unloads'));
    }
}
