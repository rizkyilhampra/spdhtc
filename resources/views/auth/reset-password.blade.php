@extends('layouts.custom')
@section('title', 'Reset Password')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Reset Password</h4>
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
                                name="token" tabindex="1" hidden>
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password"
                                class="form-control pwstrength @error('password') is-invalid @enderror"
                                data-indicator="pwindicator" name="password" tabindex="2" autofocus required>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                            <div class="invalid-feedback">
                                @error('password')
                                    {{ $message }}
                                @else
                                    Please fill in your password
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                tabindex="2" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @section('footer')
            @parent
        @endsection
    </div>
</div>
@endsection
@section('jsPage')
<script src="../assets/js/page/auth-register.js"></script>
@endsection

@section('jsLibraries')
<script src="{{ asset('spesifiedAssets/jquery.pwstrength.min.js') }}"></script>
{{-- <script src="{{ asset('spesifiedAssets/jquery.selectric.min.js') }}"></script> --}}
@endsection
@section('jsCustom')
<script>
    var notyf = new Notyf({
        position: {
            x: 'right',
            y: 'top',
        },
        dismissible: true
    });

    function tokenExpired() {
        if ('{{ $errors->has('email') }}') {
            let form = document.querySelector('.needs-validation');
            form.innerHTML =
                'Mohon maaf, token anda sudah kadaluarsa. Silahkan melakukan permintaan reset password kembali';
            notyf.error("{{ $errors->first('email') }}");
            setTimeout(function() {
                window.location.href = "{{ route('password.request') }}";
            }, 5000);
        }
    }
    new tokenExpired();
</script>
@endsection
