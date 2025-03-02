@extends('owner.template')

@section('content')
    <div class="row">

        <div class="col-md-6 mb-3">

            <div class="card h-100">
                <div class="row">
                    <div class="col">
                        <div class="card-header">
                            <h5 class="card-title"><b>INFORMASI PRIBADI</b></h5>
                        </div>
                        <div class="card-body pb-0">
                            <h6 class="card-subtitle mb-2">nama</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->name }}</b></h5>
                            <h6 class="card-subtitle mb-2">email</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->email }}</b></h5>
                            <h6 class="card-subtitle mb-2">posisi</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->name }}</b></h5>
                            <h6 class="card-subtitle mb-2">mulai bekerja</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->created_at->format('d-m-Y') }}</b></h5>
                            <h6 class="card-subtitle mb-2">provinsi</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->cabang->provinsi ?? '-' }}</b></h5>
                            <h6 class="card-subtitle mb-2">kota</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->cabang->kota ?? '-' }}</b></h5>
                            <h6 class="card-subtitle mb-2">cabang</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->cabang->name ?? 'Pusat' }}</b></h5>
                        </div>
                    </div>
                    <div class="col d-flex align-items-start justify-content-center ">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="foto {{ $akun->name }}"
                                width="100px">
                            <p>Foto</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="row">
                    <div class="col">
                        <div class="card-header">
                            <h5 class="card-title"><b>INFORMASI AKUN</b></h5>
                        </div>
                        <div class="card-body pb-0">
                            <h6 class="card-subtitle mb-2">username</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->name }}</b></h5>
                            <h6 class="card-subtitle mb-2">email</h6>
                            <h5 class="card-subtitle mb-4"><b>{{ $akun->email }}</b></h5>
                            <h6 class="card-subtitle mb-2">password</h6>
                            <h5 class="card-subtitle mb-4"><b>**********</b></h5>
                            <h6 class="card-subtitle mb-2">terakhir login</h6>
                            <h5 class="card-subtitle mb-4"><b>terakhir login</b></h5>
                            <h6 class="card-subtitle mb-2">status verifikasi</h6>
                            <h5 class="card-subtitle mb-4">
                                <?php
                                $verif = $akun->is_verified;
                                if ($verif = 1) {
                                    echo '<b>Terverifikasi<b/>';
                                } else {
                                    echo '<b>TIdak dikenal<b/>';
                                }
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-0">
                    <div class="m-0 p-0 divider text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-danger mx-2"><span style="margin-right:8px "
                                class="bx bx-arrow-back me-2" type="solid"></span> Kembali</a>
                        <a href="{{ url('/owner/akun/detail/edit/' . $akun->id) }} " class="btn btn-primary "><span style="margin-right:8px "
                                class=" bx bx-edit me-2"></span>Edit Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
