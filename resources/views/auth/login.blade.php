@extends('auth.auth_template') {{-- Menggunakan template main.blade.php --}}

@section('content') {{-- Isi konten halaman --}}
    <h4 class="mb-2">Selamat Datang! 👋</h4>
    <p class="mb-4">Silahkan masuk menggunakan akun yang telah divalidasi.</p>

    <form id="formAuthentication" class="mb-3" action="/login" method="POST">
        @csrf <!-- Tambahkan CSRF token -->

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                value="{{ old('email') }}" autofocus />
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                </a>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="••••••••"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember"
                    {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember-me"> Ingat Saya </label>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
        </div>

        <!-- Menampilkan error login -->
        @if (session('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>


    <p class="text-center">
        <span>Belum punya akun?</span>
        <a href="/register">
            <span>Buat akun</span>
        </a>
    </p>
@endsection
