const modalEditProfile = document.getElementById('editProfileModal');
const modalEditProfileInstance = bootstrap.Modal.getOrCreateInstance(modalEditProfile);
modalEditProfile.addEventListener('show.bs.modal', async () => {
    drawHistoriDiagnosisTable();

    const btnSubmitEditProfile = document.getElementById('btnSubmitEditProfile');
    btnSubmitEditProfile.addEventListener('click', async (e) => {
        e.preventDefault();
        Swal.fire({
            title: 'Mohon tunggu',
            html: 'Sedang memproses data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            },
        });
        try {
            const response = await ajaxPostEditProfile();
            await new Promise(resolve => setTimeout(resolve, 1000)); // Delay selama 1 detik
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message,
                showConfirmButton: false,
                timer: 1500
            });
            return window.location.reload();
        } catch (error) {
            swalError(error.responseJSON);
        }
    });

    const setElementAttributes = (element, value, disabled = false) => {
        element.value = value;
        element.disabled = disabled;
    };

    const elements = {
        nameInput: document.querySelector('input[name="name"]'),
        emailInput: document.querySelector('input[name="email"]'),
        addressTextarea: document.querySelector('textarea[name="address"]'),
        provinsiSelect: document.querySelector('#provinsi'),
        profesiInput: document.querySelector('#profesi'),
        kotaSelect: document.querySelector('#kota')
    };

    setElementAttributes(elements.nameInput, 'Mohon Tunggu...', true);
    setElementAttributes(elements.emailInput, 'Mohon Tunggu...', true);
    setElementAttributes(elements.addressTextarea, 'Mohon Tunggu...', true);
    let optionProvinsi = new Option('Mohon Tunggu', null, false, false);
    let optionKota = new Option('Mohon Tunggu', null, false, false);
    let optionProfesi = new Option('Mohon Tunggu', null, false, false);
    $(elements.provinsiSelect).append(optionProvinsi).attr('disabled', true);
    $(elements.kotaSelect).append(optionKota).attr('disabled', true);
    $(elements.profesiInput).append(optionProfesi).attr('disabled', true);

    $(elements.provinsiSelect).select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#editProfileModal'),
    });

    $(elements.kotaSelect).select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#editProfileModal'),
    });
    $(elements.profesiInput).select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#editProfileModal'),
    });

    try {
        const response = await ajaxRequestEditProfile();
        $(elements.kotaSelect).empty();

        if (response.user.profile == null) {
            response.user.profile = {
                address: '',
                province: '',
                city: '',
                profession: ''
            }
            optionKota = new Option('Pilih Provinsi terlebih dahulu', null, false, true);
            $(elements.kotaSelect).append(optionKota).attr('disabled', true);
        } else {
            optionKota = new Option('Pilih Kota', null, false, true);
            $(elements.kotaSelect).append(optionKota).attr('disabled', false);
            optionKota.disabled = true;
        }

        setElementAttributes(elements.nameInput, response.user.name);
        setElementAttributes(elements.emailInput, response.user.email);
        setElementAttributes(elements.addressTextarea, response.user.profile.address);

        $(elements.provinsiSelect).empty();
        optionProvinsi = new Option('Pilih Provinsi', null, false, true);
        $(elements.provinsiSelect).append(optionProvinsi).attr('disabled', false);
        optionProvinsi.disabled = true;

        $(elements.profesiInput).empty();
        optionProfesi = new Option('Pilih Profesi', null, false, true);
        $(elements.profesiInput).append(optionProfesi).attr('disabled', false);
        optionProfesi.disabled = true;


        response.provinsi.forEach((value) => {
            if (value.province_id == response.user.profile.province) {
                const option = new Option(value.province, value.province_id, true, true);
                $(elements.provinsiSelect).append(option);
            } else {
                const option = new Option(value.province, value.province_id, false, false);
                $(elements.provinsiSelect).append(option);
            }
        });
        response.profesi.forEach(value => {
            if (value == response.user.profile.profession) {
                const option = new Option(value, value, true, true);
                $(elements.profesiInput).append(option);
            } else {
                const option = new Option(value, value, false, false);
                $(elements.profesiInput).append(option);
            }
        });
        try {
            const response2 = await ajaxCityRequest($(elements.provinsiSelect).val());
            response2.forEach(value => {
                if (value.city_id == response.user.profile.city) {
                    const option = new Option(value.city_name, value.city_id, true,
                        true);
                    $(elements.kotaSelect).append(option);
                } else {
                    const option = new Option(value.city_name, value.city_id, false,
                        false);
                    $(elements.kotaSelect).append(option);
                }
            });
        } catch (error) {
            if (!error.status == 404) {
                swalError(error.responseJSON);
            }
        }

    } catch (error) {
        swalError(error.responseJSON);
    }


    $(elements.provinsiSelect).on('select2:select', async (e) => {
        $(elements.kotaSelect).empty();
        optionKota = new Option('Mohon Tunggu', null, false, false);
        $(elements.kotaSelect).append(optionKota).attr('disabled', true);
        try {
            const response = await ajaxCityRequest(e.params.data.id);
            $(elements.kotaSelect).empty();
            optionKota = new Option('Pilih Kota', null, false, true);
            optionKota.disabled = true;
            $(elements.kotaSelect).append(optionKota).attr('disabled', false);
            response.forEach(value => {
                const option = new Option(value.city_name, value.city_id,
                    false,
                    false);
                $(elements.kotaSelect).append(option);
            });
        } catch (error) {
            if (!error.status == 404) {
                swalError(error.responseJSON);
            }
        }
    });
});

$(document).on('select2:open', () => {
    window.addEventListener('keydown', function (e) {
        let dropdown = $('.select2-hidden-accessible');
        if ((e.key === 'Escape' || e.key === 'Esc') && $('.select2-container--open').length) {
            e.stopPropagation();
            dropdown.select2('close');
            return false;
        }
    }, true);
});

modalEditProfile.addEventListener('hide.bs.modal', async () => {
    $('#provinsi').empty();
    $('#kota').empty();
    $('#profesi').empty();
});

