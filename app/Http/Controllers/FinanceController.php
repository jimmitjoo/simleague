<?php

namespace App\Http\Controllers;

use App\Club;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function show($locale, Club $club)
    {
        $transactions = $club->transactions()->paginate();
        return view('finance.show')->with(['club' => $club, 'transactions' => $transactions]);
    }
}
