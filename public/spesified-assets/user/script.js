function buttonToTop(top) {
    let button = $('#upScroll');
    if (top) {
        return button.addClass('show');
    } else {
        return button.removeClass('show');
    }
}

async function drawHistoriDiagnosisTable() {
    $('#historiDiagnosisTable').DataTable({
        destroy: true,
        scrollX: true,
        serverSide: true,
        processing: true,
        lengthMenu: [5, 10, 25, 50],
        pageLength: 5,
        ajax: {
            url: "histori-diagnosis-user",
            type: "GET",
            data: function (data) { // Menggunakan "data" sebagai argumen
                return data; // Mengembalikan "data" yang diterima
            },
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
                return `<button class="btn btn-outline-primary me-1" onclick="detailHistoriDiagnosis(${data}, ${row.no})">
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

async function detailHistoriDiagnosis(id, no) {
    const detailHistoriDiagnosis = document.getElementById('detailHistoriDiagnosis');
    const table = detailHistoriDiagnosis.querySelector('table');
    const tableBody = table.querySelector('tbody');
    const sectionHeading = detailHistoriDiagnosis.querySelector('h2');
    //remove all child element in table body
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }
    sectionHeading.innerHTML = "";

    function ajaxRequestToHistoriDiagnosisDetail() {
        return $.ajax({
            url: "/histori-diagnosis-user/detail",
            method: "GET",
            data: {
                id: id,
                no: no
            }
        });
    }
    try {
        const response = await ajaxRequestToHistoriDiagnosisDetail();
        response.answerLog.forEach((item, index) => {
            sectionHeading.innerHTML = `Detail Diagnosis No.${item.no}`;
            const tableRow = document.createElement('tr');
            const tableData = document.createElement('td');
            const tableData2 = document.createElement('td');
            const tableData3 = document.createElement('td');
            let number = index + 1;
            tableData.innerHTML = number;
            tableData2.innerHTML = item.name;
            tableData3.innerHTML = item.answer;
            tableRow.appendChild(tableData);
            tableRow.appendChild(tableData2);
            tableRow.appendChild(tableData3);
            tableBody.appendChild(tableRow);
        });

        detailHistoriDiagnosis.classList.remove('d-none');
        detailHistoriDiagnosis.scrollIntoView({
            behavior: 'smooth'
        });
    } catch (error) {
        swalError(error.responseJSON);
    }
}

function ajaxRequestToHistoriDiagnosis() {
    return $.ajax({
        url: "/histori-diagnosis-user",
        method: "GET"
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
        cancelButtonText: 'Tutup'
    }).fire();
    if (result.isConfirmed) {
        window.location.reload();
    }
};

function applyNavbarClassesDark() {
    return $('.navbar')
        .removeClass('bg-body-transparent')
        .addClass('color-fren-green')
        .attr('data-bs-theme', 'dark').css({
            'transition': 'all .5s ease-in-out'
        }),
        $('svg path')
            .attr('style', 'fill: #fff !important')
            .css({
                'transition': 'all .5s ease-in-out'
            }),
        $('.navbar-nav li a div button').removeClass('btn-outline-dark').addClass('btn-outline-light').css({
            'transition': 'all .5s ease-in-out'
        })
}

function applyNavbarClassesLight() {
    return $('.navbar')
        .removeClass('color-fren-green')
        .removeAttr('data-bs-theme')
        .addClass('bg-body-transparent').css({
            'transition': 'all .5s ease-in-out'
        }),
        $('svg path')
            .removeAttr('style')
            .css({
                'transition': 'all .5s ease-in-out'
            }),
        $('.navbar-nav li a div button').removeClass('btn-outline-light').addClass('btn-outline-dark').css({
            'transition': 'all .5s ease-in-out'
        })
}

function ajaxGetGejala() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/get-gejala",
            type: "GET",
            dataType: "json",
            success: function (response) {
                resolve(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                reject(xhr);
            }
        });
    });
}


document.addEventListener('DOMContentLoaded', async () => {
    const notyf = new Notyf({
        position: {
            x: 'right',
            y: 'top',
        },
        dismissible: true,
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
        tooltipTriggerEl))

    let navbarActive = false;
    $('.navbar').on('show.bs.collapse', () => {
        applyNavbarClassesDark();
        navbarActive = true;
    });
    $('.navbar').on('hide.bs.collapse', () => {
        navbarActive = false;
        if ($(this).scrollTop() > 5) {
            applyNavbarClassesDark();
        } else {
            applyNavbarClassesLight();
        }
    });

    const section = $('div.section');
    $('li.nav-item a').first().addClass('active');

    $(window).scroll(async function () {
        if ($(this).scrollTop() > 5) {
            await applyNavbarClassesDark();
            buttonToTop(true);
        } else {
            await applyNavbarClassesLight();
            if (navbarActive) {
                await applyNavbarClassesDark();
            }
            buttonToTop(false);
        }
        let scrollPosition = $(this).scrollTop();
        section.each(function () {
            let sectionTop = $(this).offset().top - 100;
            let sectionBottom = sectionTop + $(this).outerHeight();
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                $('.navbar-nav li a').removeClass('active');
                $('.navbar-nav li a[href="#' + $(this).attr('id') + '"]').addClass(
                    'active');
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
                cancelButtonText: 'Batal'
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
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    modalEditProfileInstance.show();
                }
            });
        } else {
            function ajaxRequestToDiagnosis(element, jawaban) {
                return $.ajax({
                    url: "/diagnosis",
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        idgejala: element,
                        value: jawaban
                    },
                });
            }

            async function modalResult(response, terdeteksi = true, title, text, icon) {
                const {
                    isConfirmed,
                    isDenied,
                } = await Swal.fire({
                    title: title,
                    text: text,
                    icon: icon,
                    showCancelButton: true,
                    showDenyButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Lihat Histori Diagnosis',
                    cancelButtonText: 'Tutup',
                    denyButtonText: 'Diagnosis Ulang'
                });

                if (isConfirmed) {
                    await new Promise((resolve) => {
                        // Memeriksa setiap 100ms apakah swal telah dihancurkan
                        const interval = setInterval(() => {
                            if (!document.querySelector(
                                '.swal2-container')) {
                                clearInterval(interval);
                                resolve();
                            }
                        }, 100);
                    });
                    modalEditProfileInstance.show();
                } else if (isDenied) {
                    showModal();
                } else {
                    Swal.close();
                }
            }

            async function showModal() {
                const swalBeforeDiagnosis = await Swal.fire({
                    title: 'Catatan',
                    text: 'Sistem ini memiliki keterbatasan dalam cakupan data penyakit tanaman cabai, sehingga tidak semua penyakit dapat didiagnosis. Hanya penyakit yang terdapat dalam daftar penyakit yang dapat didiagnosis. Apakah Anda ingin melanjutkan proses diagnosis?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Lanjutkan',
                    cancelButtonText: 'Batal'
                });
                if (swalBeforeDiagnosis.isConfirmed) {
                    const swalLoading = Swal.fire({
                        title: 'Mohon tunggu',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    let gejala, countGejala;
                    try {
                        gejala = await ajaxGetGejala();
                        countGejala = gejala.length;
                    } catch (error) {
                        swalError(error.responseJSON);
                    }
                    swalLoading.close();

                    //looping Swal sebanyak jumlah gejala
                    let isClosed = false;
                    for (let i = 0; i < countGejala; i++) {
                        const element = gejala[i];
                        const {
                            value: jawaban,
                            dismiss: dismissReason
                        } = await Swal.fire({
                            title: 'Pertanyaan ' + (i + 1) + ' dari ' +
                                countGejala,
                            text: 'Apakah ' + element.name +
                                '?',
                            icon: 'question',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya',
                            showDenyButton: true,
                            denyButtonColor: '#d33',
                            denyButtonText: 'Tidak',
                            showCloseButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            reverseButtons: true,
                        });
                        if (dismissReason == Swal.DismissReason.close) {
                            isClosed = true;
                            break;
                        }
                        try {
                            const response = await ajaxRequestToDiagnosis(element.id, jawaban);
                            if (response[1] != null) {
                                await Swal.close();
                                modalResult(response[1], true, 'Penyakit ditemukan!',
                                    'Penyakit yang diderita adalah ' + response[1].name,
                                    'success');
                                break;
                            } else if (response.penyakitUndentified) {
                                modalResult(response.penyakitUndentified, false,
                                    'Penyakit tidak ditemukan!',
                                    'Mohon maaf, penyakit tidak dapat ditemukan', 'error');
                            }
                        } catch (error) {
                            swalError(error.responseJSON);
                        }
                    }
                } else {
                    Swal.close();
                }
            }
            showModal();
        }
    });

    const btnNavLinkProfile = document.querySelector('#btnNavLinkProfile') ?? null;
    if (btnNavLinkProfile != null) {
        btnNavLinkProfile.addEventListener('click', async (e) => {
            e.preventDefault();
            modalEditProfileInstance.show();
        })
    }

    if (isUser) {
        if (login && !localStorage.getItem('notyfshown')) {
            notyf.success(login);
            localStorage.setItem('notyfshown', true);
        } else {
            localStorage.removeItem('notyfshown');
        }
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
                    src: `${assetStorage}/${penyakitImage[index].image}`,
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
