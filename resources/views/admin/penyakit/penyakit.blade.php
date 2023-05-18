@extends('layouts.app')

@push('cssLibraries')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@push('jsLibraries')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
@endpush

@push('jsCustom')
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Penyakit Page</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('admin.penyakit.tambah') }}" class="btn btn-primary" type="button">
                    Tambah Data
                </a>
                <a href="{{ route('admin.penyakit.tambah') }}" class="btn btn-warning" type="button">
                    Cetak Data
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama</th>
                                    <th>Penyebab</th>
                                    <th>Solusi</th>
                                    <th>Tanggal Dibuat/Diubah</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($penyakit as $p)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->reason }}</td>
                                        <td>{{ $p->solution }}</td>
                                        <td>{{ $p->updated_at }}</td>
                                        <td>
                                            <img alt="image" src="{{ asset('storage/penyakit/' . $p->image) }}"
                                                class="" width="200" data-toggle="tooltip"
                                                title="{{ $p->name }}">
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item btn btn-outline-warning"
                                                        href="{{ route('admin.penyakit.edit', ['id' => $p->id]) }}">Edit</a>
                                                    <a class="dropdown-item btn btn-outline-danger" id="btnHapus">Hapus</a>
                                                    <form id="formHapus"
                                                        action="{{ route('admin.penyakit.destroy', ['id' => $p->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('jsCustom')
    <script>
        const btnhapus = document.querySelectorAll('#btnHapus');
        const form = document.querySelectorAll('#formHapus');
        btnhapus.forEach((element, index) => {
            element.addEventListener('click', (e) => {
                e.preventDefault();
                const konfirmasi = confirm('Apakah anda yakin ingin menghapus data ini?');
                if (konfirmasi) {
                    form[index].submit();
                }
            })
        });
    </script>
@endpush