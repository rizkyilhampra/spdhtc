@extends('layouts.custom')

@section('title', 'Email Verifikasi')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Verifikasi Email</h4>
                </div>

                <div class="card-body">
                    <p id="textStatusEmail">
                        {{ __('Sebelum memproses, tolong cek email anda untuk mendapatkan link verifikasi.') }}
                        {{ __('Jika anda tidak mendapatkan email') }},
                    </p>
                    <form method="POST" id="verifEmail" action="{{ route('verification.send') }}" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="form-group">
                            <button type="submit" id="resendVerifEmail" class="btn btn-primary btn-lg btn-block"
                                tabindex="4">
                                Kirim Ulang Email Verifikasi
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
        if (status == 'verification-link-sent') {
            let resendVerifEmail = document.getElementById('resendVerifEmail');
            resendVerifEmail.remove();
            textStatusEmail.innerHTML = 'Email verifikasi telah dikirim ke email anda!\n';
            textStatusEmail.innerHTML += 'Tolong cek email anda dan klik link untuk memverifikasi akun anda';
            return notyf.success('Email verifikasi telah dikirim ke email anda!');
        }
    }

    new emailHasSent();
</script>
@endsection
