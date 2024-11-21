@extends('layouts.admin.app')

@push('cssLibraries')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@push('jsLibraries')
    <script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
@endpush

@push('jsCustom')
    <script>
        const table = document.getElementById('table-1');
        const dataTable = $(table).DataTable({});
        $(document).on("click", "#table-1 #btnHapus", function(e) {
            e.preventDefault();
            var form = $(this).closest("td").find("form");
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) form.submit();
                });
        });
    </script>
@endpush


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Histori Diagnosis</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('histori.diagnosis.pdf') }}" target="_blank" class="btn btn-warning text-dark"
                    type="button">
                    Cetak Data
                </a>
            </div>
            @if (session('error'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Pengguna</th>
                                    @auth
                                        <th>Email Pengguna</th>
                                    @endauth
                                    <th>Nama Penyakit</th>
                                    <th>Tanggal Dibuat/Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diagnosis as $key => $value)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $value['user']['name'] }}</td>
                                        @auth
                                            <td>{{ $value['user']['email'] }}</td>
                                        @endauth
                                        @if ($value['penyakit']['id'] == null)
                                            <td><span class="badge bg-danger text-white">Penyakit tidak ditemukan</span>
                                            </td>
                                        @else
                                            <td>{{ $value['penyakit']['name'] }}</td>
                                        @endif
                                        <td>{{ $value['updated_at'] }}</td>
                                        <td>
                                            <a href="{{ route('admin.histori.diagnosis.detail', $value['id']) }}"
                                                class="btn btn-primary" type="button">
                                                Detail
                                            </a>
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
