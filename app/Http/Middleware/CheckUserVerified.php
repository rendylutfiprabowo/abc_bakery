<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akun Anda belum diverifikasi. Silakan hubungi admin.');
        }
        return $next($request);
    }
}
