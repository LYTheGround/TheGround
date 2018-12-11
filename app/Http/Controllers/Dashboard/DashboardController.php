<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $countUsers = "5";
        $countProfit = "1000";
        $countTaxes = "200";
        $countTva = "350";
        $positions = "";
        $users = "";
        return view('dashboard',compact('countUsers','countProfit','countTva','countTaxes'));
    }
}
