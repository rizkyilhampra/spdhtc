@extends('layouts.custom')

@section('title', 'Email Verification')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Email Verify</h4>
                </div>

                <div class="card-body">
                    <p id="textStatusEmail">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </p>
                    <form method="POST" id="verifEmail" action="{{ route('verification.send') }}" class="needs-validation"
                        novalidate="">
                        @csrf
                        <div class="form-group">
                            <button type="submit" id="resendVerifEmail" class="btn btn-primary btn-lg btn-block"
                                tabindex="4">
                                Resend Verification Email
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
            textStatusEmail.innerHTML += 'Please check your email and click on the link to verify your account.';
            return notyf.success('Email verifikasi telah dikirim ke email anda!');
        }
    }

    new emailHasSent();
</script>
@endsection
