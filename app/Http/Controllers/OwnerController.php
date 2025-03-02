<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function OwnerDashboard()
    {
        $title = 'dashboard';
        return view('owner.dashboard', compact('title'));
    }

    public function Akun(Request $request)
    {
        $title = 'akun';

        // Query awal untuk mengambil data user dengan relasi role & cabang
        $query = User::with('role', 'cabang');

        // Jika ada pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                ->orWhereHas('role', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
        }

        // Ambil hasil dengan pagination
        $akun = $query->paginate(2);

        return view('owner.akun.akun', compact('title', 'akun'));
    }

    public function ShowAkunDetail($id)
    {
        $title = 'detail akun';
        $akun = User::with('role', 'cabang')->findOrFail($id);
        return view('owner.akun.akundetail', compact('title', 'akun'));
    }

    public function ShowakunDetailEdit(Request $request)
    {
        $title = 'edit akun';

        // // Query awal untuk mengambil data user dengan relasi role & cabang
        // $query = User::with('role', 'cabang');

        // // Jika ada pencarian
        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where('name', 'LIKE', "%$search%")
        //         ->orWhereHas('role', function ($q) use ($search) {
        //             $q->where('name', 'LIKE', "%$search%");
        //         });
        // }

        // // Ambil hasil dengan pagination
        // $akun = $query->paginate(2);

        return view('owner.akun.formakundetailedit', compact('title'));
    }

    public function updateVerification(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->is_verified = $request->is_verified;
            $user->save();

            return response()->json(['success' => 'Verifikasi berhasil diperbarui.']);
        }

        return response()->json(['success' => 'User tidak ditemukan.'], 404);
    }
}
