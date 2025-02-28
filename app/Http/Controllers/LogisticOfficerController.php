<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogisticOfficerController extends Controller
{
    public function LogisticOfficerDashboard()
    {
        return view('logisticOfficer.dashboard');
    }
}
