<div class="modal fade" id="editProfileModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Profil</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="" class="row justify-content-center ">
                    <div class="col-12 col-sm-8 py-5">
                        <div class="d-flex justify-content-between">
                            <h2 class="font-semibold pb-3">
                                Edit Profil
                            </h2>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('update-profile') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row pb-3">
                                        <div class="col-lg-6 col-12">
                                            <label for="name" class="form-label font-medium">Nama</label>
                                            <input type="text" class="form-control" name="name" value="">
                                        </div>
                                        <div class="col-lg-6 col-12 pt-3 pt-sm-0">
                                            <label for="email" class="form-label font-medium">Email</label>
                                            <input type="email" class="form-control" name="email" readonly
                                                value="">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label font-medium">Alamat</label>
                                        <textarea rows="3" name="address" class="form-control" id="exampleFormControlInput1">{{ old('address', $user->profile->address ?? null) }}</textarea>
                                    </div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label for="province" class="form-label font-medium">Provinsi</label>
                                                <select class="form-select select-custom" name="province" id="provinsi"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Pilih Provinsi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label for="city"
                                                    class="form-label font-medium">Kota/Kabupaten</label>
                                                <select disabled class="form-select select-custom" name="city"
                                                    id="kota" aria-label="Default select example">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="profession" class="form-label font-medium">Profesi</label>
                                        <select class="form-select select-custom" name="profession" id="profesi"
                                            aria-label="Default select example">
                                            <option disabled selected>Pilih Profesi</option>
                                        </select>
                                    </div>
                                    <div class="pt-3 ">
                                        <div class="d-grid">
                                            <button type="submit" id="btnSubmitEditProfile"
                                                class="btn btn-success">Simpan</button>
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
            </div>
        </div>
    </div>
</div>

@push('scriptSpecific')
    <script>
        $(document).ready(function() {
            const btnNavLinkProfile = document.getElementById('btnNavLinkProfile');
            btnNavLinkProfile.addEventListener('click', (e) => {
                e.preventDefault();
                const modalEditProfile = new bootstrap.Modal(document.getElementById(
                    'editProfileModal'));
                modalEditProfile.show();

                $('input[name="name"]').attr({
                    'value': 'Please wait...',
                    'disabled': true
                });

                $('input[name="email"]').attr({
                    'value': 'Please wait...',
                    'disabled': true
                });

                $('textarea[name="address"]').attr({
                    'disabled': true
                }).val('Please wait...');

                $('#provinsi').attr('disabled', true).val('Please wait...');

                $('#profesi').attr('disabled', true);

                var getUserCity = '';
                $('#kota').empty();
                $('#kota').append(
                    '<option value="">Please wait...</option>');
                $('#kota').prop('disabled', true);


                $.ajax({
                    url: "{{ route('edit-profile') }}",
                    method: "GET",
                    success: function(data) {

                        $('input[name="name"]').attr({
                            'value': data.user.name,
                            'disabled': false
                        });

                        $('input[name="email"]').attr({
                            'value': data.user.email,
                            'disabled': false
                        });

                        $('textarea[name="address"]').attr({
                            'disabled': false
                        }).val(data.user.profile.address ?? '');

                        $.each(data.provinsi, function(index, value) {
                            if (value.province_id == data.user.profile.province) {
                                $('#provinsi').append($('<option>').text(value.province)
                                        .val(value.province_id).attr('selected', true))
                                    .attr('disabled', false);
                            } else {
                                $('#provinsi').append($('<option>').text(value.province)
                                    .val(value.province_id)).attr('disabled', false);
                            }
                        });

                        $.each(data.profesi, function(index, value) {
                            if (value == data.user.profile.profession) {
                                $('#profesi').append($('<option>').text(value)
                                        .val(value).attr('selected', true))
                                    .attr('disabled', false);
                            } else {
                                $('#profesi').append($('<option>').text(value)
                                    .val(value)).attr('disabled', false);
                            }
                        });

                    },
                    complete: function(data) {
                        ajaxCityRequest(data.responseJSON
                            .user
                            .profile.province).then(function(city, error) {
                            if (error == 'success') {
                                $('#kota').empty();
                                $('#kota').append(
                                    '<option disabled selected value="">Pilih Kota</option>'
                                );
                                $('#kota').prop('disabled', false);
                                $.each(city, function(key, value) {
                                    if (value.city_id ==
                                        data.responseJSON.user.profile.city) {
                                        $('#kota').append(
                                            '<option value="' +
                                            value.city_id +
                                            '" selected>' +
                                            value
                                            .city_name +
                                            '</option>');
                                    } else {
                                        $('#kota').append(
                                            '<option value="' +
                                            value.city_id +
                                            '">' + value
                                            .city_name +
                                            '</option>');
                                    }
                                });
                            }
                        });

                        $('#provinsi').change(function() {
                            $('#kota').empty();
                            $('#kota').prop('disabled', true);
                            $('#kota').append(
                                '<option value="">Please wait...</option>');
                            var provinsi_id = $(this).val();
                            ajaxCityRequest(provinsi_id).then(function(city, error) {
                                if (error == 'success') {
                                    $('#kota').empty();
                                    $('#kota').append(
                                        '<option disabled selected value="">Pilih Kota</option>'
                                    );
                                    $('#kota').prop('disabled', false);
                                    $.each(city, function(key, value) {
                                        $('#kota').append(
                                            '<option value="' +
                                            value.city_id +
                                            '">' + value
                                            .city_name +
                                            '</option>');
                                    });
                                }
                                console.log(error);
                            });
                        });
                    }
                });
            });

            const btnSubmitEditProfile = document.getElementById('btnSubmitEditProfile');
            btnSubmitEditProfile.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Mohon tunggu',
                    html: 'Sedang memproses data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });

                postEditProfile().then(function(respone) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: respone.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        location.reload();
                    });
                }).catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });

            function postEditProfile() {
                return $.ajax({
                    url: "{{ route('update-profile') }}",
                    method: "POST",
                    data: {
                        _method: 'PUT',
                        _token: "{{ csrf_token() }}",
                        name: $('input[name="name"]').val(),
                        email: $('input[name="email"]').val(),
                        address: $('textarea[name="address"]').val(),
                        province: $('#provinsi').val(),
                        city: $('#kota').val(),
                        profession: $('#profesi').val(),
                    },
                    success: (respone) => respone,
                    error: (error) => error
                });
            }

            function ajaxCityRequest(provinsi_id) {
                return $.ajax({
                    url: '/edit-profile/lokasi/kota/' + provinsi_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        return city = data;
                    },
                    error: function(error) {
                        return error;
                    }
                });
            }
        });
    </script>
@endpush
