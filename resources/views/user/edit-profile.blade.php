@extends('layouts.user.app')
@push('stylePerPage')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('title', 'SPDHTC | Edit Profil')
@section('content')
    <div id="" class="row min-vh-100 justify-content-center section pt-5">
        <div class="col-12 col-sm-8 py-5">
            <div class="d-flex justify-content-between">
                <h2 class="font-semibold pb-3">
                    Edit Profil
                </h2>
                <a href="{{ route('index') }}" class="btn btn-link">Kembali</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('update-profile') }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="row pb-3">
                            <div class="col-sm-6 col-12">
                                <label for="name" class="form-label font-medium">Nama</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-sm-6 col-12 pt-3 pt-sm-0">
                                <label for="email" class="form-label font-medium">Email</label>
                                <input type="email" class="form-control" name="email" readonly
                                    value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label font-medium">Alamat</label>
                            <textarea rows="3" name="address" class="form-control" id="exampleFormControlInput1">{{ old('address', $user->profile->address ?? null) }}</textarea>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label for="province" class="form-label font-medium">Provinsi</label>
                                    <select class="form-select select-custom" name="province" id="provinsi"
                                        aria-label="Default select example">
                                        <option selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsi as $p)
                                            @if ($p->province_id == old('province', $user->profile->province ?? null))
                                                <option value="{{ $p->province_id }}" selected>
                                                    {{ $p->province }}</option>
                                            @else
                                                <option value="{{ $p->province_id }}">{{ $p->province }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <div class="mb-3">
                                    <label for="city" class="form-label font-medium">Kota</label>
                                    <select disabled class="form-select select-custom" name="city" id="kota"
                                        aria-label="Default select example">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profession" class="form-label font-medium">Profesi</label>
                            <select class="form-select select-custom" name="profession" aria-label="Default select example">
                                <option disabled selected>Pilih Profesi</option>
                                @foreach ($profesi as $pi => $value)
                                    @if ($value == old('profession', $user->profile->profession ?? null))
                                        <option value="{{ $value }}" selected>{{ $value }}
                                        </option>
                                    @else
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-3 ">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 py-5">
            <h2 class="font-semibold pb-3">
                Histori Diagnosis
            </h2>
            <div class="card shadow">
                <div class="card-body">
                    hallo
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scriptPerPage')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-custom').select2({
                theme: 'bootstrap-5'
            });

            applyNavbarClassesDark();
            const btnNavLinkProfile = document.querySelector('#btnNavLinkProfile div button');
            btnNavLinkProfile.classList.remove('btn-outline-light');
            btnNavLinkProfile.classList.add('btn-light');

            let navLink = document.querySelector('ul.navbar-nav').querySelectorAll('li a');
            for (let i = 0; i < navLink.length; i++) {
                navLink[i].setAttribute('href', '{{ route('index') }}');
            }
            var selectedOption = $('#provinsi').find(':selected');
            if (selectedOption.text() != 'Pilih Provinsi') {
                $('#kota').append('<option value="">Please wait</option>');
                var provinsi_id = selectedOption.val();
                if (provinsi_id) {
                    $.ajax({
                        url: '/edit-profile/lokasi/kota/' + provinsi_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kota').empty();
                            $('#kota').append('<option disabled selected value="">Pilih Kota</option>');
                            $('#kota').prop('disabled', false);
                            $.each(data, function(key, value) {
                                if (value.city_id ==
                                    '{{ old('city', $user->profile->city ?? null) }}') {
                                    $('#kota').append('<option value="' + value.city_id +
                                        '" selected>' + value.city_name + '</option>');
                                } else {
                                    $('#kota').append('<option value="' + value.city_id +
                                        '">' + value.city_name + '</option>');
                                }
                            });
                        },
                        error: function(data) {
                            data.forEach(function(e) {
                                alert(e);
                            });
                        }
                    });
                } else {
                    $('#kota').empty();
                    $('#kota').append('<option disabled value="">Pilih Kota</option>');
                }
            }

            $('#provinsi').change(function() {
                $('#kota').empty();
                $('#kota').prop('disabled', true);
                $('#kota').append('<option value="">Please wait</option>');
                var provinsi_id = $(this).val();
                if (provinsi_id) {
                    $.ajax({
                        url: '/edit-profile/lokasi/kota/' + provinsi_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kota').empty();
                            $('#kota').append(
                                '<option disabled selected value="">Pilih Kota</option>');
                            $('#kota').prop('disabled', false);
                            $.each(data, function(key, value) {
                                $('#kota').append('<option value="' + value.city_id +
                                    '">' + value.city_name + '</option>');
                            });
                        },
                        error: function(data) {
                            data.forEach(function(e) {
                                alert(e);
                            });
                        }
                    });
                } else {
                    $('#kota').empty();
                    $('#kota').append('<option disabled value="">Pilih Kota</option>');
                }
            });


            const error = @json(session('error') ?? false);
            const success = @json(session('success') ?? false);

            if (error) {
                notyf.error(error);
            } else if (success) {
                notyf.success(success);
            }
        });
    </script>
@endpush
