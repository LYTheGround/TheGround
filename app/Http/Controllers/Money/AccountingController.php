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
        $accounting = auth()->user()->member->company->accounting;
        //$months = $accounting->months->orderBy('date', 'desc')->get();
        $months = Month::where('accounting_id',$accounting->id)->orderBy('date', 'desc')->get();
        return view('money.accounting.index',compact('accounting','months'));
    }

    public function show(Month $month)
    {
        // purchased
       $purchaseds =  $month->purchaseds;
        // solds
        $solds = $month->solds;
        // unloads
        $unloads = $month->unloads;
        return view('money.accounting.show',compact('solds','purchaseds','unloads'));
    }
}
