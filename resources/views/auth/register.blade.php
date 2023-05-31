@extends('layouts.auth-layout')
@section('title', 'Daftar')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Daftar</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" required autofocus autocomplete="name"
                                placeholder="Masukkan nama anda">
                            <div class="invalid-feedback">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @else
                                    Tolong isi nama anda
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="nama@email.com"
                                name="email">
                            <div class="invalid-feedback">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @else
                                    Tolong isi email anda
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Kata Sandi</label>
                                <input id="password" type="password"
                                    class="form-control pwstrength @error('password') is-invalid @enderror"
                                    data-indicator="pwindicator" autocomplete="new-password" placeholder="Min. 8 karakter"
                                    required name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @else
                                        Tolong isi password anda
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="password_confirmation" class="d-block">Konfirmasi Password</label>
                                <input id="password_confirmation" required type="password" placeholder="Min. 8 karakter"
                                    class="form-control
                                    @error('password') is-invalid @enderror"
                                    name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Daftar
                            </button>
                        </div>
                        <div class="text-center mt-4 mb-3">
                            <div class="text-job text-muted">Atau daftar dengan</div>
                        </div>
                        <div class="row sm-gutters">
                            <div class="col-12">
                                <a class="btn btn-block btn-social btn-google" href="{{ route('google') }}"
                                    onclick="event.preventDefault(); document.getElementById('google-form').submit();">
                                    <span class="fab fa-google"></span> Google
                                </a>
                                <form id="google-form" action="{{ route('google') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
@endsection

@push('jsPage')
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
@endpush

@push('jsLibraries')
    <script src="{{ asset('spesified-assets/jquery.pwstrength.min.js') }}"></script>
@endpush

@push('cssLibraries')
    <link rel="stylesheet" href="{{ asset('spesified-assets/bootstrap-social.css') }}">
@endpush
