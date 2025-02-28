<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionOfficerController extends Controller
{
    public function ProductionOfficerDashboard()
    {
        return view('productionofficer.dashboard');
    }
}
