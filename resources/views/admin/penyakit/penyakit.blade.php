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
            <h1>Halaman Penyakit</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('admin.penyakit.tambah') }}" class="btn btn-primary" type="button">
                    Tambah Data
                </a>
                <a href="{{ route('penyakit.pdf') }}" target="_blank" class="btn btn-warning text-dark" type="button">
                    Cetak Data
                </a>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible show fade">
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
                                    <th>Nama</th>
                                    <th>Penyebab</th>
                                    <th>Solusi</th>
                                    <th>Tanggal Dibuat/Diubah</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penyakit as $p)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
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
