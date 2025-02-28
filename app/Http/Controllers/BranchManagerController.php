<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchManagerController extends Controller
{
    public function BranchManagerDashboard()
    {
        return view('branchmanager.dashboard');
    }
    //
}
