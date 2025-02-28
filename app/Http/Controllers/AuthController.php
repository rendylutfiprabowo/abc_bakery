<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        if (Auth::check()) {
            // Arahkan ke dashboard berdasarkan role
            switch (Auth::user()->role->name) {
                case 'Owner':
                    return redirect()->route('owner.dashboard');
                case 'Branch Manager':
                    return redirect()->route('branchmanager.dashboard');
                case 'Cashier':
                    return redirect()->route('cashier.dashboard');
                case 'Production Officer':
                    return redirect()->route('productionofficer.dashboard');
                case 'Logistic Officer':
                    return redirect()->route('logisticofficer.dashboard');
                default:
                    return redirect()->route('login');
            }
        }

        $roles = Role::where('name', '!=', 'Owner')->get();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'is_verified' => false,
            'terms' => true,
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Mohon hubungi owner untuk verifikasi akun.');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            // Arahkan ke dashboard berdasarkan role
            switch (Auth::user()->role->name) {
                case 'Owner':
                    return redirect()->route('owner.dashboard');
                case 'Branch Manager':
                    return redirect()->route('branchmanager.dashboard');
                case 'Cashier':
                    return redirect()->route('cashier.dashboard');
                case 'Production Officer':
                    return redirect()->route('productionofficer.dashboard');
                case 'Logistic Officer':
                    return redirect()->route('logisticofficer.dashboard');
                default:
                    return redirect()->route('login'); // Jika role tidak cocok
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil status Remember Me
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route(getDashboardRoute());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
