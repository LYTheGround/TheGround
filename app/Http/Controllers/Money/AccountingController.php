<?php

namespace App\Http\Controllers\Money;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function index()
    {
        $accountings = DB::table('accountings')
            ->join('companies','accountings.company_id','companies.id')
            ->join('sales','sales.company_id','companies.id')
            ->get();
        dd($accountings);
    }
}
