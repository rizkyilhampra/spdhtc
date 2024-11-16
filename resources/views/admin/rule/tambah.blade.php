@extends('layouts.admin.app')

@push('cssLibraries')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
@endpush

@push('jsLibraries')
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Tambah Aturan</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('admin.rule') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.rule.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Penyakit</label>
                            <select name="penyakit" id="penyakit" required
                                class="form-control select2 @error('penyakit') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Penyakit</option>
                                @foreach ($penyakit as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Gejala</label>
                            <select name="gejala[]" multiple id="gejala" required
                                class="form-control select2 @error('gejala') is-invalid @enderror">
                                @foreach ($gejala as $g)
                                    <option value="{{ $g->id }}">G{{ $g->id }}, {{ $g->name }}</option>
                                @endforeach
                            </select>
                            @error('gejala')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
