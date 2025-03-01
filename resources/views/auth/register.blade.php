    @extends('auth.auth_template') {{-- Menggunakan template main.blade.php --}}

    @section('content')
        {{-- Isi konten halaman --}}

        @if ($errors->has('terms'))
            <div class="card-body m-0 p-0">
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('terms') }}
                </div>
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="card-body m-0 p-0">
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('password') }}
                </div>
            </div>
        @endif


        <h4 class="mb-2">Selamat bergabung! 🚀</h4>
        <p class="mb-4">Wujudkan mimpimu bersama kami.</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan username"
                    required autofocus value="{{ old('name') }}" />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                    required value="{{ old('email') }}" />
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Pilih Role</label>
                <select class="form-control" id="role_id" name="role_id" required onchange="toggleFields()">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                    {{-- @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <!-- Bungkus Kota, Provinsi, dan Cabang dalam div untuk disembunyikan -->
            <div id="extraFields" style="display: none;">
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Pilih Provinsi</label>
                    <select class="form-control" id="provinsi_id" name="provinsi_id">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinsi as $p)
                            <option value="{{ $p->provinsi_id }}"
                                {{ old('provinsi_id') == $p->provinsi_id ? 'selected' : '' }}>
                                {{ $p->provinsi }}
                            </option>
                        @endforeach
                        {{-- @foreach ($provinsi as $p)
                            <option value="{{ $p->provinsi_id }}">{{ $p->provinsi }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kota_id" class="form-label">Pilih Kota</label>
                    <span data-bs-toggle="tooltip" class="text-left" data-bs-placement="right" data-bs-html="true"
                        title= "<small>Mohon pilih provinsi terlebih dahulu.</small>">
                        <i class="bx bx-info-circle mx-1"></i>
                    </span>
                    <select class="form-control" id="kota_id" name="kota_id">
                        <option value="">-- Pilih Kota --</option>
                        {{-- @foreach ($kota as $item)
                            <option value="{{ $item->kota_id }}">{{ $item->kota }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cabang_id" class="form-label">Pilih Cabang</label>
                    <span data-bs-toggle="tooltip" class="text-left" data-bs-placement="right" data-bs-html="true"
                        title= "<small>Mohon pilih kota terlebih dahulu.</small>">
                        <i class="bx bx-info-circle mx-1"></i>
                    </span>
                    <select class="form-control" id="cabang_id" name="cabang_id">
                        <option value="">-- Pilih Cabang --</option>
                        {{-- @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>


            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password
                    <span data-bs-toggle="tooltip" class="text-left" data-bs-placement="right" data-bs-html="true"
                        title= "<small>Minimal 6 karakter mengandung huruf besar dan kecil, angka, dan karakter khusus (@, $, !, %, *, ?, &).</small>">
                        <i class="bx bx-info-circle mx-1"></i>
                    </span>
                </label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="********"
                        required />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>

            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <span data-bs-toggle="tooltip" class="text-left" data-bs-placement="right" data-bs-html="true"
                    title= "<small>Mohon pastikan password dan password konfirmasi memiliki karakter yang sesuai.</small>">
                    <i class="bx bx-info-circle mx-1"></i>
                </span>
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

        <script>
            function toggleFields() {
                let roleSelect = document.getElementById("role_id");
                let extraFields = document.getElementById("extraFields");

                // Ambil teks dari option yang dipilih
                let selectedRole = roleSelect.options[roleSelect.selectedIndex].text;

                // Jika Branch Manager atau Cashier, tampilkan field tambahan
                if (selectedRole === "Branch Manager" || selectedRole === "Cashier") {
                    extraFields.style.display = "block";
                } else {
                    extraFields.style.display = "none";
                }
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let selectedProvinsi = "{{ old('provinsi_id') }}";
                let selectedKota = "{{ old('kota_id') }}";
                let selectedCabang = "{{ old('cabang_id') }}";

                if (selectedProvinsi) {
                    $('#provinsi_id').val(selectedProvinsi).trigger('change');
                }

                if (selectedKota) {
                    setTimeout(function() {
                        $('#kota_id').val(selectedKota).trigger('change');
                    }, 1000); // Tunggu data kota dimuat
                }

                if (selectedCabang) {
                    setTimeout(function() {
                        $('#cabang_id').val(selectedCabang);
                    }, 1500); // Tunggu data cabang dimuat
                }
            });

            $(document).ready(function() {
                console.log("Script berjalan!");

                $('#provinsi_id').on('change', function() {
                    let provinsi_id = $(this).val();
                    $('#kota_id').html('<option value="">-- Pilih Kota --</option>');
                    $('#cabang_id').html('<option value="">-- Pilih Cabang --</option>');

                    if (provinsi_id) {
                        $.ajax({
                            url: '/get-kota/' + provinsi_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log("Data Kota:", data);
                                $.each(data, function(key, kota) {
                                    $('#kota_id').append('<option value="' + kota.id +
                                        '">' + kota.kota + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#kota_id').on('change', function() {
                    let kota_id = $(this).val();
                    $('#cabang_id').html('<option value="">-- Pilih Cabang --</option>');

                    if (kota_id) {
                        $.ajax({
                            url: '/get-cabang/' + kota_id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log("Data Cabang:", data);
                                $.each(data, function(key, cabang) {
                                    $('#cabang_id').append('<option value="' + cabang.id +
                                        '">' + cabang.name + '</option>');
                                });
                            }
                        });
                    }
                });
            });
        </script>

        <script>
            document.getElementById('provinsi_id').addEventListener('change', function() {
                console.log("Provinsi dipilih:", this.value);
            });
            document.getElementById('kota_id').innerHTML = ''; // Harus dikosongkan lebih dulu
            data.forEach(kota => {
                console.log("Menambahkan kota:", kota.nama);
            });
        </script>
    @endsection
