@extends('layouts.auth-layout')

@section('title', 'Masuk')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Masuk</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" tabindex="1" autocomplete="email"
                                placeholder="nama@email.com" required autofocus>
                            <div class="invalid-feedback">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @else
                                    Tolong isi email anda
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Kata Sandi</label>
                                <div class="float-right">
                                    <a href="{{ route('password.request') }}" class="text-small">
                                        Lupa kata sandi?
                                    </a>
                                </div>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password" placeholder="Masukkan kata sandi anda" required
                                tabindex="2">
                            <div class="invalid-feedback">
                                @if ($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @else
                                    Tolong isi kata sandi anda
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Masuk
                            </button>
                        </div>
                    </form>
                    <div class="text-center mt-4 mb-3">
                        <div class="text-job text-muted">Atau masuk dengan</div>
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
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                Belum punya akun? <a href="{{ route('register') }}">Daftar disini </a>
            </div>
        </div>
    </div>
@endsection
@push('jsCustom')
    <script>
        const status = '{{ session('status') }}';
        if (status) {
            notyf.success(status);
        }
    </script>
@endpush
@push('cssLibraries')
    <link rel="stylesheet" href="{{ asset('spesified-assets/bootstrap-social.css') }}">
@endpush
