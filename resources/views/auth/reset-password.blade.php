@extends('layouts.auth-layout')
@section('title', 'Reset Kata Sandi')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Reset Kata Sandi</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" value="{{ $request->email }}" type="email" class="form-control"
                                name="email" tabindex="1" readonly>
                        </div>
                        <div class="form-group" hidden>
                            <label for="token">Token</label>
                            <input id="token" value="{{ $request->token }}" type="text" class="form-control"
                                name="token" tabindex="2" hidden>
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi Baru</label>
                            <input id="password" type="password"
                                class="form-control pwstrength @error('password') is-invalid @enderror"
                                data-indicator="pwindicator" name="password" autocomplete="new-password"
                                placeholder="Min. 8 Karakter" tabindex="3" autofocus required>
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
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 karakter"
                                name="password_confirmation" tabindex="4" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="5">
                                Reset Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
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
@push('jsCustom')
    <script>
        const errorHasEmail = '{{ $errors->has('email') }}';
        const errorMsgEmail = '{{ $errors->first('email') }}';
        const routePasswordRequest = "{{ route('password.request') }}";
        tokenExpired();
    </script>
@endpush
