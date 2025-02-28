@extends('auth.auth_template') {{-- Menggunakan template main.blade.php --}}

@section('content')
    {{-- Isi konten halaman --}}

    <h4 class="mb-2">Selamat bergabung! 🚀</h4>
    <p class="mb-4">Wujudkan mimpimu bersama kami.</p>

    <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan username" required
                autofocus />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                required />
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Pilih Role</label>
            <select class="form-control" id="role_id" name="role_id" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="********"
                    required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>

        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                    placeholder="********" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" name="terms" required />
                <label class="form-check-label" for="terms">
                    Saya setuju dengan <a href="#">kebijakan & ketentuan privasi</a>
                </label>
            </div>
        </div>

        <button class="btn btn-primary d-grid w-100">Buat akun</button>
    </form>

    <p class="text-center">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}"><span>Masuk</span></a>
    </p>
@endsection
