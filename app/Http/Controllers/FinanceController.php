<?php

namespace App\Http\Controllers;

use App\Club;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function show($locale, Club $club)
    {
        $transactions = $club->transactions()->paginate();

        $lastWeekCosts = $club->transactions()->whereDate('created_at', '>', now()->subWeek())->sum('sum');

        return view('finance.show')->with(['club' => $club, 'transactions' => $transactions, 'lastWeekCosts' => $lastWeekCosts]);
    }
}
