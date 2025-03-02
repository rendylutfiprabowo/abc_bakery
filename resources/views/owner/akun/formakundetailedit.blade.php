@extends('owner.template')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <form action=" " method="">
                @csrf

                <div class="row p-4">
                    <div class="col divider text-start my-0 py-0">
                        <h5 class="card-header m-0 p-0">Edit Data Karyawan</h5>
                    </div>
                    <div class="col divider text-end  my-0 py-0">
                        <div class="m-0 p-0 divider text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-danger mx-2"><span style="margin-right:8px "
                                    class="bx bx-arrow-back me-2" type="solid"></span> Kembali</a>
                            <a href=" " class="btn btn-primary "><span style="margin-right:8px "
                                    class=" bx bx-save me-2"></span>Simpan Data</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ old('email') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" value="{{ old('name') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Jabatan / Posisi</label>
                        <input type="text" class="form-control" id="role" value="{{ old('role') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <select class="form-select" id="provinsi" aria-label="Default select example">
                            <option selected value="{{ old('name') }}">Pilih Provinsi</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <select class="form-select" id="kota" aria-label="Default select example">
                            <option selected value="{{ old('name') }}">Pilih Kota</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cabang" class="form-label">Cabang</label>
                        <select class="form-select" id="cabang" aria-label="Default select example">
                            <option selected value="{{ old('name') }}">Pilih Cabang</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                    <label for="name" class="form-label">Cabang</label>
                    <input type="text" class="form-control" id="name" value="{{ old('name') }}" />
                </div>
                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" value="{{ old('kota') }}" />
                </div>
                <div class="mb-3">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" value="{{ old('provinsi') }}" />
                </div> --}}
                    <div class="mb-3">
                        <label for="is_verified" class="form-label">Verifikasi</label>
                        <input disabled type="text" class="form-control" id="is_verified"
                            value="{{ old('is_verified') }}" />
                    </div>
                    <div class="mb-3">
                        <label for="remember_token" class="form-label">Terakhir Masuk</label>
                        <input disabled type="text" class="form-control" id="remember_token"
                            value="{{ old('remember_token') }}" />
                    </div>


                    {{-- <div class="mb-3">
                    <label for="exampleFormControlReadOnlyInput1" class="form-label">Read only</label>
                    <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1"
                        placeholder="Readonly input here..." readonly />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Read plain</label>
                    <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1"
                        value="email@example.com" />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">Example select</label>
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleDataList" class="form-label">Datalist example</label>
                    <input class="form-control" list="datalistOptions" id="exampleDataList"
                        placeholder="Type to search..." />
                    <datalist id="datalistOptions">
                        <option value="San Francisco"></option>
                        <option value="New York"></option>
                        <option value="Seattle"></option>
                        <option value="Los Angeles"></option>
                        <option value="Chicago"></option>
                    </datalist>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlSelect2" class="form-label">Example multiple select</label>
                    <select multiple class="form-select" id="exampleFormControlSelect2"
                        aria-label="Multiple select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div> --}}
                    <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Catatan Karyawan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mt-3 divider text-end">
                        <div class="m-0 p-0 divider text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-danger mx-2"><span style="margin-right:8px "
                                    class="bx bx-arrow-back me-2" type="solid"></span> Kembali</a>
                            <a href=" " class="btn btn-primary "><span style="margin-right:8px "
                                    class=" bx bx-save me-2"></span>Simpan Data</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
