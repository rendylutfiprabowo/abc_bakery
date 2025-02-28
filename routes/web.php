<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchManagerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\LogisticOfficerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductionOfficerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

//login
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route(getDashboardRoute());
    }
    return view('auth.login');
})->name('login');
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(getDashboardRoute());
    }
    return redirect('/login'); // Jika belum login, tetap ke login
});
Route::post('/login', [AuthController::class, 'login']);

//logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//owner
Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'OwnerDashboard'])->name('owner.dashboard');
    Route::get('/owner/employee', [OwnerController::class, 'Employee'])->name('owner.employee');
});

Route::middleware(['auth', 'role:Branch Manager'])->group(function () {
    Route::get('/branchmanager/dashboard', [BranchManagerController::class, 'BranchManagerDashboard'])->name('branchmanager.dashboard');
});

Route::middleware(['auth', 'role:Cashier'])->group(function () {
    Route::get('/cashier/dashboard', [CashierController::class, 'CashierDashboard'])->name('cashier.dashboard');
});

Route::middleware(['auth', 'role:Production Officer'])->group(function () {
    Route::get('/productionofficer/dashboard', [ProductionOfficerController::class, 'ProductionOfficerDashboard'])->name('productionofficer.dashboard');
});

Route::middleware(['auth', 'role:Logistic Officer'])->group(function () {
    Route::get('/logisticofficer/dashboard', [LogisticOfficerController::class, 'LogisticOfficerDashboard'])->name('logisticofficer.dashboard');
});


function getDashboardRoute()
{
    $user = Auth::user();
    if (!$user) return 'login';

    return match ($user->role->name) {
        'Owner' => 'owner.dashboard',
        'Branch Manager' => 'branchmanager.dashboard',
        'Cashier' => 'cashier.dashboard',
        'Production Officer' => 'productionofficer.dashboard',
        'Logistic Officer' => 'logisticofficer.dashboard',
        default => 'login',
    };
}
