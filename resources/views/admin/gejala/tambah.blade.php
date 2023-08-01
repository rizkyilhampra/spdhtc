@extends('layouts.admin.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Halaman Tambah Gejala</h1>
        </div>
        <div class="section-body">
            <div class="pb-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.gejala.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Gejala</label>
                            <input type="text" required class="form-control @error('gejala') is-invalid @enderror"
                                name="gejala" id="gejala" value="{{ old('gejala') }}">
                            @error('gejala')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" required class="form-control @error('image') is-invalid @enderror"
                                name="image" id="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="card card-body mt-3 d-none container-image-preview">
                                <img class="img-fluid" width="300" id="imagePreview" src="">
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

                const containerImagePreview = document.querySelector('.container-image-preview');
                containerImagePreview.classList.remove('d-none');
            });
        });
    </script>
@endpush
