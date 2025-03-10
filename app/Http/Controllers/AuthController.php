<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Kota;
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
        $cabangs = Cabang::with('kota', 'provinsi')->get();
        $provinsi = Kota::select('provinsi_id', 'provinsi')->distinct()->get();
        $kota = Kota::select('kota_id', 'kota')->distinct()->get();
        // dd($provinsi->pluck('provinsi_id'));
        // $kota = $cabangs->pluck('kota.provinsi');
        // $provinsi = $cabangs->pluck('kota.provinsi');
        // $id_kota = $cabangs->pluck('kota_id');
        // dd($kota);
        return view('auth.register', compact(
            'roles',
            'cabangs',
            'kota',
            'provinsi',
        ));
    }

    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            // 'cabang_id' => 'required|exists:cabangs,id',
            'terms' => 'accepted',
        ], [
            'password.confirmed' => 'Password dan Konfirmasi Password harus sama.',
            'password.regex' => 'Password harus terdiri dari huruf besar dan kecil, angka, dan karakter khusus.',
            'terms.accepted' => 'Mohon setujui kebijakan & ketentuan privasi.',
        ]);

        try {
            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'cabang_id' => $request->cabang_id,
                'is_verified' => false,
                'terms' => true,
            ]);
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Mohon hubungi owner untuk verifikasi akun.');
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'cabang_id' => $request->cabang_id,
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

        // Ambil user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        // Jika user belum diverifikasi
        if (!$user->is_verified) {
            return back()->withErrors(['email' => 'Akun Anda belum diverifikasi. Silakan hubungi admin.'])->withInput();
        }

        // Ambil status Remember Me
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route(getDashboardRoute());
        }

        return back()->withErrors([
            'error' => 'Email atau password salah.',
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
