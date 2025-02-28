<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function CashierDashboard()
    {
        return view('cashier.dashboard');
    }
}
