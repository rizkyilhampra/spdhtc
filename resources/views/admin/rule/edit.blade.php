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
            <h1>Halaman Ubah Aturan No {{ $rule['id'] }}</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('admin.rule') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.rule.update', $rule['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Penyakit</label>
                            <select name="penyakit" id="penyakit" required
                                class="form-control select2 @error('penyakit') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Penyakit</option>
                                @foreach ($penyakit as $p)
                                    <option value="{{ $p->id }}" @if ($p->id == $rule['penyakit_id']) selected @endif>
                                        {{ $p->name }}</option>
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
                            <select name="gejala" id="gejala" required
                                class="form-control select2 @error('gejala') is-invalid @enderror">
                                @foreach ($gejala as $g)
                                    <option value="{{ $g->id }}" @if ($g->id == $rule['gejala_id']) selected @endif>
                                        G{{ $g->id }}, {{ $g->name }}</option>
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
