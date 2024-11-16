function buttonToTop(top) {
    let button = $('#upScroll');
    if (top) {
        return button.addClass('show');
    } else {
        return button.removeClass('show');
    }
}

function drawHistoriDiagnosisTable() {
    $('#historiDiagnosisTable').DataTable({
        destroy: true,
        scrollX: true,
        serverSide: true,
        processing: true,
        lengthMenu: [5, 10, 25, 50],
        pageLength: 5,
        order: [0, 'desc'],
        columnDefs: [{
            targets: 2,
            orderable: false
        },
        {
            targets: 3,
            orderable: false
        }],
        ajax: {
            url: "histori-diagnosis-user",
            type: "GET",
            error: function (xhr, error, thrown) {
                swalError(xhr.responseJSON);
            }
        },
        columns: [{
            data: 'no',
        },
        {
            data: 'created_at',
            render: function (data, type, row, meta) {
                const date = new Date(data);
                const formattedDateTime = ("0" + date.getDate()).slice(-2) + "/" +
                    ("0" + (date.getMonth() + 1)).slice(-2) + "/" +
                    date.getFullYear() + " " +
                    ("0" + date.getHours()).slice(-2) + ":" +
                    ("0" + date.getMinutes()).slice(-2) + ":" +
                    ("0" + date.getSeconds()).slice(-2);
                return formattedDateTime;
            }
        },
        {
            data: 'penyakit.name',
            render: function (data, type, row, meta) {
                //handle if data is null
                if (data == null) {
                    return `<span class="badge bg-danger">Penyakit tidak ditemukan</span>`;
                }
                return data;
            }
        },
        {
            data: 'id',
            render: function (data, type, row, meta) {
                return `<button class="btn btn-outline-primary me-1" onclick="getPenyakitIdFromHistori(${data}, ${row.no})">
                        <i class="fa-solid fa-eye"></i>
                    <button class="btn btn-outline-danger" onclick="deleteHistoriDiagnosis(${data})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    `;
            }
        },
        ]
    });
}

function deleteHistoriDiagnosis(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "histori-diagnosis-user",
                method: "DELETE",
                data: {
                    _token: csrfToken,
                    id: id
                },
                success: async function (response) {
                    Swal.fire(
                        'Terhapus!',
                        result.value.message,
                        'success'
                    );
                    $('#historiDiagnosisTable').DataTable().clear().draw();
                },
                error: function (error) {
                    swalError(error.responseJSON);
                }
            });
        }
    });
}

function ajaxRequestEditProfile() {
    return $.ajax({
        url: "/edit-profile",
        method: "GET",
    });
}

function ajaxPostEditProfile() {
    return $.ajax({
        url: "/edit-profile",
        method: "POST",
        data: {
            _method: 'PUT',
            _token: csrfToken,
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            address: $('textarea[name="address"]').val(),
            province: $('#provinsi').val(),
            city: $('#kota').val(),
            profession: $('#profesi').val(),
        },
    });
}

function ajaxCityRequest(provinsi_id) {
    return $.ajax({
        url: '/edit-profile/lokasi/kota/' + provinsi_id,
        type: 'GET',
        dataType: 'json',
    });
}

const swalError = async (error) => {
    const result = await Swal.mixin({
        title: 'Terjadi kesalahan',
        text: error.message,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Muat Ulang',
        cancelButtonText: 'Tutup',
        reverseButtons: true
    }).fire();
    if (result.isConfirmed) {
        window.location.reload();
    }
};

function applyNavbarClassesDark() {
    const navbar = document.querySelector('.navbar');
    const svgPaths = Array.from(document.querySelectorAll('svg path'));
    const navbarButtons = Array.from(document.querySelectorAll('.navbar-nav li a div button'));

    navbar.classList.remove('bg-body-transparent');
    navbar.classList.add('color-fren-green');
    navbar.setAttribute('data-bs-theme', 'dark');
    navbar.style.transition = 'all .5s ease-in-out';

    svgPaths.forEach((path) => {
        path.setAttribute('style', 'fill: #fff !important');
        path.style.transition = 'all .5s ease-in-out';
    });

    navbarButtons.forEach((button) => {
        button.classList.remove('btn-outline-dark');
        button.classList.add('btn-outline-light');
        button.style.transition = 'all .5s ease-in-out';
    });
}

function applyNavbarClassesLight() {
    const navbar = document.querySelector('.navbar');
    const svgPaths = Array.from(document.querySelectorAll('svg path'));
    const navbarButtons = Array.from(document.querySelectorAll('.navbar-nav li a div button'));

    navbar.classList.remove('color-fren-green');
    navbar.removeAttribute('data-bs-theme');
    navbar.classList.add('bg-body-transparent');
    navbar.style.transition = 'all .5s ease-in-out';

    svgPaths.forEach((path) => {
        path.removeAttribute('style');
        path.style.transition = 'all .5s ease-in-out';
    });

    navbarButtons.forEach((button) => {
        button.classList.remove('btn-outline-light');
        button.classList.add('btn-outline-dark');
        button.style.transition = 'all .5s ease-in-out';
    });
}

document.addEventListener('DOMContentLoaded', async () => {
    const notyf = new Notyf({
        position: {
            x: 'center',
            y: 'top',
        },
        dismissible: true,
    });

    if (isUser) {
        if (login != false) {
            notyf.success(login);
        }
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
        tooltipTriggerEl))

    let navbarActive = false;
    const navbar = document.querySelector('.navbar');
    const sections = Array.from(document.querySelectorAll('div.section'));
    const navbarNavItems = Array.from(document.querySelectorAll('.navbar-nav li a'));

    navbar.addEventListener('show.bs.collapse', () => {
        applyNavbarClassesDark();
        navbarActive = true;
    });

    navbar.addEventListener('hide.bs.collapse', () => {
        navbarActive = false;
        if (window.scrollY > 5) {
            applyNavbarClassesDark();
        } else {
            applyNavbarClassesLight();
        }
    });

    window.addEventListener('scroll', async () => {
        if (window.scrollY > 5) {
            applyNavbarClassesDark();
            buttonToTop(true);
        } else {
            applyNavbarClassesLight();
            if (navbarActive) {
                applyNavbarClassesDark();
            }
            buttonToTop(false);
        }

        const scrollPosition = window.scrollY;
        sections.forEach((section) => {
            const sectionTop = section.offsetTop - 100;
            const sectionBottom = sectionTop + section.offsetHeight;
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                navbarNavItems.forEach((item) => {
                    item.classList.remove('active');
                });
                const correspondingNavItem = navbarNavItems.find((item) => {
                    return item.getAttribute('href') === `#${section.id}`;
                });
                if (correspondingNavItem) {
                    correspondingNavItem.classList.add('active');
                }
            }
        });
    });


    const btnNavbar = [
        btnBeranda = document.querySelector('.beranda'),
        btnDiagnosis = document.querySelector('.diagnosis'),
        btnPenyakit = document.querySelector('.penyakit'),
    ];
    btnNavbar.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const href = btn.getAttribute('href');
            const offsetTop = document.querySelector(href).offsetTop;
            scroll({
                top: offsetTop,
                behavior: 'smooth'
            });
        });
    });

    let buttonScrollTop = document.getElementById('upScroll');
    buttonScrollTop.addEventListener(
        'click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

    $('#pills-1-tab').addClass('active');
    $('#pills-1').addClass('show active');

    let btnDiagnosis2 = document.querySelector('#btn-diagnosis');
    btnDiagnosis2.addEventListener('click', function (e) {
        e.preventDefault();
        if (!isUser) {
            Swal.fire({
                title: 'Anda belum login!',
                text: 'Silahkan login terlebih dahulu',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/login";
                }
            })
        } else if (!hasUserProfile) {
            Swal.fire({
                title: 'Anda belum melengkapi profil!',
                text: 'Silahkan lengkapi profil terlebih dahulu untuk melakukan diagnosis',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lengkapi Profil',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    modalEditProfileInstance.show();
                }
            });
        } else {
            new DiagnosisModal(assetStorageGejala, csrfToken).showModal();
        }
    });

    const btnNavLinkProfile = document.querySelector('#btnNavLinkProfile') ?? null;
    if (btnNavLinkProfile != null) {
        btnNavLinkProfile.addEventListener('click', async (e) => {
            e.preventDefault();
            modalEditProfileInstance.show();
        })
    }

    const openImageChocolat = document.querySelectorAll('.open-image-chocolat');

    openImageChocolat.forEach((element, index) => {
        const image = element.querySelector('.chocolat-image');
        image.addEventListener('click', async (event) => {
            event.preventDefault();
            const lebarLayar = window.innerWidth || document.documentElement.clientWidth || document
                .body.clientWidth;

            if (lebarLayar >= 992) {
                const instanceChocolat = await Chocolat([{
                    src: `${assetStoragePenyakit}/${penyakitImage[index].image}`,
                    title: penyakitImage[index].name
                }], {});

                instanceChocolat.api.open();
            }
        });
    });
});

window.addEventListener('load', async () => {
    const gambarCabai = document.getElementById('gambar-cabai');

    new simpleParallax(gambarCabai, {
        delay: 1,
        transition: 'cubic-bezier(0,0,0,1)'
    });
    const addClassOnLoadSimpleParallax = () => {
        $('.simpleParallax').addClass('rounded-4').addClass('shadow-custom');
    }
    addClassOnLoadSimpleParallax();

    const splashScreen = document.querySelector('.splash-screen');
    splashScreen.style.opacity = 0;
    setTimeout(() => {
        splashScreen.classList.add('hidden');
    }, 300);

    AOS.init({
        duration: 800,
        once: true
    });
});
