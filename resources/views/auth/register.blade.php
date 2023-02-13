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
                    <h4>Register</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password"
                                    class="form-control pwstrength @error('password') is-invalid @enderror"
                                    data-indicator="pwindicator" name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-6">
                                <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control @if ($errors->has('password')) is-invalid @endif"
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
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="agree">I agree with the terms and
                                    conditions</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3 text-muted text-center">
                Already have an account? <a href="{{ route('login') }}">Login</a>
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
    registerButton.addEventListener('click', function(e) {
        e.preventDefault();
        register().then(function(result) {
            if (result) {
                document.querySelector('form').submit();
            }
        });
    });
    async function register() {
        if (agreeCheckbox.checked) {
            return true;
        } else {
            toastr().error('You must agree with the terms and conditions');
            return false;
        }
    }
</script>
@endsection

@section('jsPage')
<script src="../assets/js/page/auth-register.js"></script>
@endsection

@section('jsLibraries')
<script src="{{ asset('spesifiedAssets/jquery.pwstrength.min.js') }}"></script>
{{-- <script src="{{ asset('spesifiedAssets/jquery.selectric.min.js') }}"></script> --}}
@endsection

{{-- @section('cssLibraries')
<link rel="stylesheet" href="{{ asset('spesifiedAssets/selectric.css') }}">
@endsection --}}
