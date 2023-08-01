@extends('layouts.admin.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Edit Penyakit No {{ $penyakit->id }}</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ route('admin.penyakit') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.penyakit.update', ['id' => $penyakit->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Nama Penyakit</label>
                            <input type="text" class="form-control @error('penyakit') is-invalid @enderror"
                                name="penyakit" id="penyakit" value="{{ old('penyakit', $penyakit->name) }}">
                            @error('penyakit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Penyebab</label>
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" name="reason"
                                id="reason" value="{{ old('reason', $penyakit->reason) }}">
                            @error('reason')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Solusi</label>
                            <textarea name="solution" class="form-control @error('solution') is-invalid @enderror" id="solution"
                                style="height: 200px">{{ old('solution', $penyakit->solution) }}</textarea>
                            @error('solution')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <div class="card card-body mt-3">
                                <img class="img-fluid" width="300" id="imagePreview"
                                    src="{{ asset('storage/penyakit/' . $penyakit->image) }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('jsCustom')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('image');

            input.addEventListener('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.getElementById('imagePreview');
                    img.src = e.target.result;
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
