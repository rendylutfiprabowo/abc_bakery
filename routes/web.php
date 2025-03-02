<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchManagerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\LogisticOfficerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductionOfficerController;
use App\Models\Cabang;
use App\Models\Kota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/get-kota/{provinsi_id}', function ($provinsi_id) {
    $kota = Kota::where('provinsi_id', $provinsi_id)->get();
    return response()->json($kota);
});
Route::get('/get-cabang/{kota_id}', function ($kota_id) {
    $cabang = Cabang::where('kota_id', $kota_id)->get();
    return response()->json($cabang);
});

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
Route::middleware(['auth', 'verified', 'role:Owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'OwnerDashboard'])->name('owner.dashboard');
    Route::get('/owner/akun', [OwnerController::class, 'Akun'])->name('owner.akun');
    Route::get('/owner/akun/detail/{id}', [OwnerController::class, 'ShowAkunDetail']);
    Route::get('/owner/akun/detail/edit/{id}', [OwnerController::class, 'ShowAkunDetailEdit']);

    Route::get('/owner/bye', [OwnerController::class, 'bye'])->name('owner.bye');
    Route::post('/owner/update-verification', [OwnerController::class, 'updateVerification'])->name('owner.updateVerification');
    // Route::get('/owner/employee/edit', [OwnerController::class, 'ShowEmployeeEdit'])->name('employee.edit');
    // Route::get('/owner/employee/edit/update', [OwnerController::class, 'Employeeupdate'])->name('employee.update');
    // Route::get('/employees', [OwnerController::class, 'Employeeindex'])->name('employee.index');
});

//branch manager
Route::middleware(['auth', 'verified', 'role:Branch Manager'])->group(function () {
    Route::get('/branchmanager/dashboard', [BranchManagerController::class, 'BranchManagerDashboard'])->name('branchmanager.dashboard');
});

//Cashier
Route::middleware(['auth', 'verified', 'role:Cashier'])->group(function () {
    Route::get('/cashier/dashboard', [CashierController::class, 'CashierDashboard'])->name('cashier.dashboard');
});

// Production Officer
Route::middleware(['auth', 'verified', 'role:Production Officer'])->group(function () {
    Route::get('/productionofficer/dashboard', [ProductionOfficerController::class, 'ProductionOfficerDashboard'])->name('productionofficer.dashboard');
});

// Logistic Officer
Route::middleware(['auth', 'verified', 'role:Logistic Officer'])->group(function () {
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
