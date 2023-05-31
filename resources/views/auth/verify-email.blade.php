@extends('layouts.auth-layout')

@section('title', 'Email Verifikasi')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
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
        </div>
    </div>
@endsection

@push('jsCustom')
    <script>
        const statusSession = '{{ session('status') }}';
        emailHasSent();
        cekSession();
    </script>
@endpush
