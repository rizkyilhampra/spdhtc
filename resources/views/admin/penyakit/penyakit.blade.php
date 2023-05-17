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
                                    <th>Tanggal Dibuat</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- <tr>
                                    <td>

                                    </td>
                                    <td>Create a mobile app</td>
                                    <td class="align-middle">
                                        <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                            <div class="progress-bar bg-success" data-width="100%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle"
                                            width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                    </td>
                                    <td>2018-01-20</td>
                                    <td>
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
