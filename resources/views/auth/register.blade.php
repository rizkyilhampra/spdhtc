@extends('layouts.custom')
@section('title', 'Register')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

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
                                value="{{ old('name') }}" name="name" required autofocus>
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
                                value="{{ old('email') }}" required name="email">
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
                                    data-indicator="pwindicator" required name="password">
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
                                <input id="password_confirmation" required type="password"
                                    class="form-control
                                    @error('password') is-invalid @enderror"
                                    name="password_confirmation">
                            </div>
                        </div>

                        {{-- <div class="form-divider">
                            Your Home
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Country</label>
                                <select class="form-control selectric">
                                    <option>Indonesia</option>
                                    <option>Palestine</option>
                                    <option>Syria</option>
                                    <option>Malaysia</option>
                                    <option>Thailand</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Province</label>
                                <select class="form-control selectric">
                                    <option>West Java</option>
                                    <option>East Java</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>City</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>Postal Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" required id="agree">
                                <label class="custom-control-label" for="agree">
                                    Saya setuju dengan <a href="https://rizkyilhampra.my.id" target="_blank">persyaratan dan
                                        ketentuan</a>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>

        @section('footer')
            @parent
        @endsection
    </div>
</div>
@endsection


@section('jsCustom')
<script>
    var agreeCheckbox = document.getElementById('agree');
    var registerButton = document.querySelector('button[type="submit"]');
    registerButton.addEventListener('click', () => {
        register();
    });

    function register() {
        if (!agreeCheckbox.checked) {
            // Create an instance of Notyf
            var notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                },
                dismissible: true
            });

            // Display an error notification
            notyf.error('Tolong, setujui persyaratan dan ketentuan kami!');
        }
    }
</script>
@endsection

@section('jsPage')
<script src="../assets/js/page/auth-register.js"></script>
@endsection

@section('jsLibraries')
<script src="{{ asset('spesified-assets/jquery.pwstrength.min.js') }}"></script>
{{-- <script src="{{ asset('spesified-assets/jquery.selectric.min.js') }}"></script> --}}
@endsection

{{-- @section('cssLibraries')
<link rel="stylesheet" href="{{ asset('spesified-assets/selectric.css') }}">
@endsection --}}
