@extends('owner.template')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Isi konten halaman --}}

    <!-- Hoverable Table rows -->
    @if (session()->has('success'))
        <div class="card-body m-0 p-0">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="card">
        <div class="container p-0 my-3">
            <div class="row align-items-center px-0">
                <!-- Header di kiri -->
                <div class="col-6 divider text-start mr-5">
                    <h2 class="text-right my-0 mx-3"><b>DAFTAR AKUN KARYAWAN</b></h2>
                </div>
                <!-- Search bar di kanan -->
                <div class="col-6 divider text-end ml-5">
                    <div class="row my-0 mx-3">
                        <div class="col m-0 p-0">

                        </div>
                        <div class="col m-0 p-0">
                            <form action="{{ route('owner.akun') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Cari"
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary"><i
                                        class="icon-base bx bx-search-alt-2"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi / Jabatan</th>
                        <th>Cabang</th>
                        <th>Verifikasi Akun</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($akun as $item)
                        <tr class="text-left">
                            <td class="text-center">{{ $akun->firstItem() + $loop->index }}</td>
                            <td><i class="text-danger "></i> <strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->role->name }}</td>
                            <td>
                                {{ $item->cabang->name ?? '-' }}
                            </td>
                            <td class="d-flex justify-content-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-verification" type="checkbox" role="switch"
                                        data-id="{{ $item->id }}" id="flexSwitchCheck{{ $item->id }}"
                                        {{ $item->is_verified ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/owner/akun/detail/' . $item->id) }}"><i
                                                class="bx bx-info-circle me-1"></i>
                                            Detail</a>
                                        <a class="dropdown-item" href="/owner/akun/delete"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="m-3">
                <nav aria-label="Page navigation mb-0">
                    <ul class="pagination d-flex justify-content-center">
                        {{-- Tombol "First" --}}
                        @if (!$akun->onFirstPage())
                            <li class="page-item first">
                                <a class="page-link" href="{{ $akun->url(1) }}">
                                    <i class="tf-icon bx bx-chevrons-left"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item first disabled">
                                <span class="page-link"><i class="tf-icon bx bx-chevrons-left"></i></span>
                            </li>
                        @endif

                        {{-- Tombol "Previous" --}}
                        @if ($akun->onFirstPage())
                            <li class="page-item prev disabled">
                                <span class="page-link"><i class="tf-icon bx bx-chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item prev">
                                <a class="page-link" href="{{ $akun->previousPageUrl() }}">
                                    <i class="tf-icon bx bx-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($akun->getUrlRange(1, $akun->lastPage()) as $page => $url)
                            <li class="page-item {{ $akun->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Tombol "Next" --}}
                        @if ($akun->hasMorePages())
                            <li class="page-item next">
                                <a class="page-link" href="{{ $akun->nextPageUrl() }}">
                                    <i class="tf-icon bx bx-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item next disabled">
                                <span class="page-link"><i class="tf-icon bx bx-chevron-right"></i></span>
                            </li>
                        @endif

                        {{-- Tombol "Last" --}}
                        @if ($akun->hasMorePages())
                            <li class="page-item last">
                                <a class="page-link" href="{{ $akun->url($akun->lastPage()) }}"><i
                                        class="tf-icon bx bx-chevrons-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item last disabled">
                                <span class="page-link"><i class="tf-icon bx bx-chevrons-right"></i></span>
                            </li>
                        @endif
                    </ul>
                </nav>

                {{-- Informasi jumlah data --}}
                <small class="divider divider-text mt-0">
                    Menampilkan {{ $akun->firstItem() }} - {{ $akun->lastItem() }} dari {{ $akun->total() }}
                    data
                </small>
            </div>

        </div>
    </div>
    <!--/ Hoverable Table rows -->

    <script>
        $(document).ready(function() {
            $(".toggle-verification").change(function() {
                var userId = $(this).data("id");
                var isChecked = $(this).prop("checked") ? 1 : 0;

                $.ajax({
                    url: "{{ route('owner.updateVerification') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: userId,
                        is_verified: isChecked
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
