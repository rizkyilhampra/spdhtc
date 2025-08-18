const modalEditProfile = document.getElementById('editProfileModal');
const modalEditProfileInstance = bootstrap.Modal.getOrCreateInstance(modalEditProfile);

// Initialize ProfileSelectManager
let profileSelectManager = null;

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
    };
    
    // Initialize ProfileSelectManager if not already created
    if (!profileSelectManager) {
        try {
            profileSelectManager = new ProfileSelectManager({
                provinceSelector: '#provinsi',
                regencySelector: '#kota',
                professionSelector: '#profesi',
                modalSelector: '#editProfileModal',
                theme: 'bootstrap-5'
            });
        } catch (error) {
            console.error('Failed to initialize ProfileSelectManager:', error);
            swalError({ message: 'Gagal menginisialisasi form provinsi dan kota' });
            return;
        }
    }

    // Set loading state for basic form elements
    setElementAttributes(elements.nameInput, 'Mohon Tunggu...', true);
    setElementAttributes(elements.emailInput, 'Mohon Tunggu...', true);
    setElementAttributes(elements.addressTextarea, 'Mohon Tunggu...', true);

    try {
        const response = await ajaxRequestEditProfile();
        
        // Ensure user profile exists
        if (response.user.profile == null) {
            response.user.profile = {
                address: '',
                province: '',
                city: '',
                profession: ''
            };
        }

        // Set basic form values
        setElementAttributes(elements.nameInput, response.user.name);
        setElementAttributes(elements.emailInput, response.user.email);
        setElementAttributes(elements.addressTextarea, response.user.profile.address);

        // Load data using ProfileSelectManager
        await profileSelectManager.loadInitialData(response);

    } catch (error) {
        console.error('Failed to load profile data:', error);
        swalError(error.responseJSON || { message: 'Gagal memuat data profil' });
    }


    // Province/regency selection is now handled by ProfileSelectManager
    // No additional event handlers needed here
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
    // Reset ProfileSelectManager state when modal closes
    if (profileSelectManager) {
        profileSelectManager.reset();
    }
});

