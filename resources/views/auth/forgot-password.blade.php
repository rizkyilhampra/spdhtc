@extends('layouts.custom')
@section('title', 'Lupa Password')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Lupa Kata Sandi</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted" id="textStatusEmail">Kami akan mengirimkan link untuk mereset kata sandi anda</p>
                    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @else
                                    Tolong isi email anda
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Lupa Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                <a href="{{ route('login') }}">Masuk kembali</a>
            </div>
        @section('footer')
            @parent
        @endsection
    </div>
</div>
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

    function emailHasSent() {
        let status = '{{ session('status') }}';
        let textStatusEmail = document.getElementById('textStatusEmail');
        if (status) {
            let formForgotPassword = document.querySelector('form.needs-validation');
            formForgotPassword.remove();
            textStatusEmail.innerHTML = 'Kami telah mengirimkan link untuk mereset kata sandi anda';
            return notyf.success('Email telah dikirimkan');
        }
    }

    new emailHasSent();
</script>
@endsection
