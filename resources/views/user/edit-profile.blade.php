<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('/spesifiedAssets/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<body>
    <div class="container">
        <div class="mt-5 min-vh-100">
            <div class="row">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            @error('name', 'updateProfileInformation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('email', 'updateProfileInformation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <form action="{{ route('user-profile-information.update') }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name"
                                        id="exampleFormControlInput1" value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        id="exampleFormControlInput1" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea type="text" rows="3" name="address" class="form-control" id="exampleFormControlInput1">{{ old('address', $user->profile->address) }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="province" class="form-label">Provinsi</label>
                                            <select class="form-select select-custom" name="province" id="provinsi"
                                                aria-label="Default select example">
                                                <option selected disabled>Pilih Provinsi</option>
                                                @foreach ($provinsi as $p)
                                                    @if ($p->province_id == old('province', $user->profile->province))
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
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">Kota</label>
                                            <select disabled class="form-select select-custom" name="city"
                                                id="kota" aria-label="Default select example">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="profession" class="form-label">Profesi</label>
                                    <select class="form-select select-custom" name="profession"
                                        aria-label="Default select example">
                                        <option disabled>Pilih Profesi</option>
                                        @foreach ($profesi as $pi => $value)
                                            @if ($value == old('profession', $user->profile->profession))
                                                <option value="{{ $value }}" selected>{{ $value }}
                                                </option>
                                            @else
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="{{ asset('/spesifiedAssets/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select-custom').select2({
                theme: 'bootstrap-5'
            });

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
                                if (value.city_id == {{ old('city', $user->profile->city) }}) {
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
        });

        //console log error message form validation
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                console.log('{{ $error }}');
            @endforeach
        @endif
    </script>
</body>

</html>
