@extends('layouts.user.app')
@section('title', 'SPDHTC')
@section('content')
    <div id="beranda" class="row min-vh-100 align-content-center section">
        <div class="col-12 col-md-6 py-5 " data-aos="fade-right" id="col1">
            <img class="img-fluid bg-body-tertiary rounded" id="gambar-cabai" src="{{ asset('assets/img/gambar-cabai.jpg') }}"
                alt="Gambar Cabai https://fumida.co.id/wp-content/uploads/2021/03/67.-membasmi-hama-cabai.jpg">
        </div>
        <div class="col-12 col-md-6 align-self-center px-3 px-sm-5" data-aos="fade-left" data-aos-anchor="body"
            id="col2">
            <h1 class="text-center text-sm-start font-bold ">
                Sistem Pakar Diagnosa Penyakit Tanaman Cabai
            </h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas debitis quidem nostrum sed
                id molestiae atque cumque, minima asperiores deserunt. Deserunt odit soluta nulla
                praesentium quam necessitatibus incidunt ea laudantium!
            </p>
        </div>
    </div>
    <div id="diagnosis" class="section">
        <h2 class="font-semibold pb-3" data-aos="fade-up">
            Diagnosis
        </h2>
        <div class="row">
            <div class="col-12" data-aos="fade-up">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto aliquam sint et tempora saepe
                            incidunt modi, repellendus cupiditate optio cumque tenetur sed rerum, esse, asperiores nostrum
                            excepturi laborum eveniet enim.
                        </div>
                        <div class="d-grid pt-3">
                            <button id="btn-diagnosis" class="btn btn-custom1 fs-5 font-medium">
                                Mulai Diagnosis Penyakit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="penyakit" class="row section">
        <div class="col-12">
            <h2 class="fw-semibold" data-aos="fade-up">
                Daftar Penyakit Tanaman Cabai
            </h2>
            <div class="card card-body shadow p-3 mt-3" data-aos="fade-up">
                <ul class="nav nav-pills mb-3 d-flex justify-content-center justify-content-sm-start" id="pills-tab"
                    role="tablist">
                    @foreach ($penyakit as $p)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-{{ $p->id }}-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-{{ $p->id }}" type="button" role="tab"
                                aria-controls="pills-{{ $p->id }}" aria-selected="false">{{ $p->name }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach ($penyakit as $p)
                        <div class="tab-pane fade" id="pills-{{ $p->id }}" role="tabpanel"
                            aria-labelledby="pills-{{ $p->id }}-tab" tabindex="0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 ">
                                            <div class="pb-3">
                                                <h6 class="card-title font-medium">
                                                    Nama Penyakit
                                                </h6>
                                                <p class="card-text">
                                                    {{ $p->name }}
                                                </p>
                                            </div>
                                            <div class="pb-3">
                                                <h6 class="card-title font-medium">
                                                    Penyebab Penyakit
                                                </h6>
                                                <p class="card-text">
                                                    {{ $p->reason }}
                                                </p>
                                            </div>
                                            <div class="pb-3">
                                                <h6 class="card-title font-medium">
                                                    Solusi Penyakit
                                                </h6>
                                                <p class="card-text">
                                                    {!! $p->solution = str_replace("\r\n", '<br/>', $p->solution) !!}
                                                </p>
                                            </div>
                                        </div>
                                        @php
                                            $image = $p->image;
                                            [$width, $height] = getimagesize(storage_path('app/public/penyakit/' . $image));
                                        @endphp

                                        <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center"
                                            id="column-img-penyakit">
                                            <div class="container-image-penyakit">
                                                <img data-bs-toggle="tooltip" width="{{ $width }}"
                                                    height="{{ $height }}"
                                                    data-bs-title="Gambar {{ $p->name }}" class="img-fluid"
                                                    src="{{ asset('/storage/penyakit/' . $p->image) }}"
                                                    alt="{{ $p->name }}" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="kontak" class="section">
        <h2 class="fw-semibold pb-3" data-aos="fade-up">
            Kontak
        </h2>
        <div class="row">
            <div class="col-12 col-md-7 pb-4" data-aos="fade-right" data-bs-anchor="#kontak">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="font-semibold pb-2 card-title">
                            Pengembang
                        </h4>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="image-slider">
                                    <div id="carouselExample" class="carousel slide">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active" id="people1">
                                                <img src="https://images.unsplash.com/photo-1570158268183-d296b2892211?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"
                                                    class="img-fluid" alt="...">
                                            </div>
                                            <div class="carousel-item" id="people2">
                                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=464&q=80"
                                                    class="img-fluid " alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev button-slide" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next button-slide" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 pt-3 pt-lg-0 align-self-center">
                                <div class="row pb-2" id="descPeople">
                                    <div class="card-text" id="descPeople1">
                                        <p class="mb-0 font-medium">
                                            Rizky Ilham Pratama
                                        </p>
                                        <div class="col d-grid py-2">
                                            <a class="btn btn-outline-dark text-nowrap text-start"
                                                href="mailto:rizkyilhamp16@gmail.com" type="button">
                                                <i class="fa-solid fa-envelope"></i>
                                                rizkyilhamp16@gmail.com
                                            </a>
                                        </div>
                                        <div class="col d-grid">
                                            <a class="btn btn-outline-dark text-nowrap text-start" target="_blank"
                                                type="button" href="https://instagram.com/rizkyilhampra">
                                                <i class="fa-brands fa-instagram"></i>
                                                @rizkyilhamp16
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-text d-none" id="descPeople2">
                                        <p class="mb-0 font-medium">
                                            Rizaldy Fauzan
                                        </p>
                                        <div class="col py-2 d-grid">
                                            <a class="btn btn-outline-dark text-nowrap text-start" href="#">
                                                <i class="fa-solid fa-envelope"></i>
                                                rizaldyfauzan@gmail.com
                                            </a>
                                        </div>
                                        <div class="col d-grid">
                                            <a class="btn btn-outline-dark text-nowrap text-start" target="_blank"
                                                href="#">
                                                <i class="fa-brands fa-instagram"></i>
                                                @rizaldyfauzan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5" data-aos="fade-left" data-bs-anchor="#kontak">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="font-semibold pb-2 card-title">
                            Tentang Kami
                        </h4>
                        <div class="card-text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae maiores nisi provident rerum
                            officiis, perspiciatis quae totam pariatur sint rem ullam impedit omnis vitae recusandae, ipsum
                            dicta deserunt sunt cum.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.profile-modal')
@endsection

@push('stylePerPage')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="{{ asset('/spesified-assets/aos.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('scriptPerPage')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js" type="text/javascript">
    </script>
    <script src="{{ asset('/spesified-assets/aos.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
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
                    url: "{{ route('histori-diagnosis-user') }}",
                    type: "GET",
                    data: function(data) { // Menggunakan "data" sebagai argumen
                        return data; // Mengembalikan "data" yang diterima
                    },
                    error: function(xhr, error, thrown) {
                        swalError(xhr.responseJSON);
                    }
                },
                columns: [{
                        data: 'no',
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row, meta) {
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
                        data: 'penyakit.name'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
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
                        url: "{{ route('histori-diagnosis-user.delete') }}",
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: async function(response) {
                            Swal.fire(
                                'Terhapus!',
                                result.value.message,
                                'success'
                            );
                            $('#historiDiagnosisTable').DataTable().clear().draw();
                        },
                        error: function(error) {
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
                    url: "{{ route('histori-diagnosis-user.detail') }}",
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

                await detailHistoriDiagnosis.classList.remove('d-none');
                detailHistoriDiagnosis.scrollIntoView({
                    behavior: 'smooth'
                });
            } catch (error) {
                swalError(error.responseJSON);
            }
        }

        function ajaxRequestToHistoriDiagnosis() {
            return $.ajax({
                url: "{{ route('histori-diagnosis-user') }}",
                method: "GET"
            });
        }

        function ajaxRequestEditProfile() {
            return $.ajax({
                url: "{{ route('edit-profile') }}",
                method: "GET",
            });
        }

        function ajaxPostEditProfile() {
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
        $(document).ready(function() {
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
                applyNavbarClassesLight();
                if ($(this).scrollTop() > 5) {
                    applyNavbarClassesDark();
                }
            });
            const bodyVisible = new Promise((resolve, reject) => {
                $('body').css('visibility', 'visible').animate({
                    opacity: 1
                }, 500);
                resolve();
            });

            bodyVisible.then(() => {
                AOS.init({
                    duration: 800,
                    once: true
                });
            });

            const section = $('div.section');
            $('li.nav-item a').first().addClass('active');

            $(window).scroll(function() {
                if ($(this).scrollTop() > 5) {
                    applyNavbarClassesDark();
                    buttonToTop(true);
                } else {
                    applyNavbarClassesLight();
                    if (navbarActive) {
                        applyNavbarClassesDark();
                    }
                    buttonToTop(false);
                }
                let scrollPosition = $(this).scrollTop();
                section.each(function() {
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
                btnKontak = document.querySelector('.kontak')
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


            const myCarousel = document.getElementById('carouselExample');
            myCarousel.addEventListener(
                'slide.bs.carousel', event => {
                    const id = event.relatedTarget.id;
                    if (id == 'people2') {
                        $('#descPeople1 ').addClass('d-none');
                        $('#descPeople2').removeClass('d-none');
                    } else if (id == 'people1') {
                        $('#descPeople2').addClass('d-none');
                        $('#descPeople1').removeClass('d-none');
                    }
                })

            let buttonScrollTop = document.getElementById('upScroll');
            buttonScrollTop.addEventListener(
                'click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

            const gambarCabai = document.getElementById('gambar-cabai');

            const parallax = new simpleParallax(gambarCabai, {
                delay: 1,
                transition: 'cubic-bezier(0,0,0,1)'
            });

            const addClassOnLoadSimpleParallax = new Promise((resolve, reject) => {
                resolve(() => {
                    $('.simpleParallax').addClass('rounded-4').addClass('shadow-custom');
                })
            });

            addClassOnLoadSimpleParallax.then((resolve) => resolve());

            $('#pills-1-tab').addClass('active');
            $('#pills-1').addClass('show active');

            const isUser = @json(Auth::check());
            const hasUserProfile = @json(Auth::user()->profile->id ?? false);
            let btnDiagnosis2 = document.querySelector('#btn-diagnosis');
            const modalEditProfile = document.getElementById('editProfileModal');
            const modalEditProfileInstance = bootstrap.Modal.getOrCreateInstance(modalEditProfile);
            modalEditProfile.addEventListener('shown.bs.modal', async () => {
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
                        return Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
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

                elements.kotaSelect.innerHTML = '<option value="">Mohon Tunggu...</option>';
                elements.profesiInput.innerHTML = '<option value="">Mohon Tunggu...</option>';
                elements.provinsiSelect.innerHTML = '<option value="">Mohon Tunggu...</option>';
                elements.provinsiSelect.disabled = true;
                elements.profesiInput.disabled = true;
                elements.kotaSelect.disabled = true;
                try {
                    const response = await ajaxRequestEditProfile();
                    setElementAttributes(elements.nameInput, response.user.name);
                    setElementAttributes(elements.emailInput, response.user.email);
                    setElementAttributes(elements.addressTextarea, response.user.profile
                        .address);
                    setElementAttributes(elements.provinsiSelect, '', false);
                    setElementAttributes(elements.profesiInput, '', false);
                    elements.provinsiSelect.innerHTML =
                        '<option disabled selected value="">Pilih Provinsi</option>';
                    elements.profesiInput.innerHTML =
                        '<option disabled selected value="">Pilih Profesi</option>';
                    response.provinsi.forEach(value => {
                        if (value.province_id == response.user.profile.province) {
                            elements.provinsiSelect.innerHTML +=
                                `<option value="${value.province_id}" selected>${value.province}</option>`;
                        } else {
                            elements.provinsiSelect.innerHTML +=
                                `<option value="${value.province_id}">${value.province}</option>`;
                        }
                    });
                    response.profesi.forEach(value => {
                        if (value == response.user.profile.profession) {
                            elements.profesiInput.innerHTML +=
                                `<option value="${value}" selected>${value}</option>`;
                        } else {
                            elements.profesiInput.innerHTML +=
                                `<option value="${value}">${value}</option>`;
                        }
                    });
                    elements.kotaSelect.innerHTML =
                        '<option disabled selected value="">Pilih Kota</option>';
                    if (response.user.profile.province != null) {
                        elements.kotaSelect.innerHTML =
                            '<option value="">Pilih Provinsi Terlebih Dahulu</option>';
                        try {
                            const response2 = await ajaxCityRequest(elements.provinsiSelect.value);
                            response2.forEach(value => {
                                if (value.city_id == response.user.profile.city) {
                                    elements.kotaSelect.innerHTML +=
                                        `<option value="${value.city_id}" selected>${value.city_name}</option>`;
                                    elements.kotaSelect.disabled = false;

                                } else {
                                    elements.kotaSelect.innerHTML +=
                                        `<option value="${value.city_id}">${value.city_name}</option>`;
                                }
                            });
                        } catch (error) {
                            swalError(error.responseJSON);
                        }
                    }
                } catch (error) {
                    swalError(error.responseJSON);
                }

                elements.provinsiSelect.addEventListener('change', async (e) => {
                    elements.kotaSelect.innerHTML =
                        '<option value="">Mohon Tunggu...</option>';
                    elements.kotaSelect.disabled = true;
                    try {
                        const response = await ajaxCityRequest(e.target.value);
                        elements.kotaSelect.innerHTML =
                            '<option disabled selected value="">Pilih Kota</option>';
                        elements.kotaSelect.disabled = false;
                        response.forEach(value => {
                            elements.kotaSelect.innerHTML +=
                                `<option value="${value.city_id}">${value.city_name}</option>`;
                        });
                    } catch (error) {
                        swalError(error.responseJSON);
                    }
                });
                await drawHistoriDiagnosisTable();
            });

            function ajaxGetGejala() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: "{{ route('get-gejala') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            resolve(response);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            reject(xhr);
                        }
                    });
                });
            }


            btnDiagnosis2.addEventListener('click', function(e) {
                e.preventDefault();
                if (!isUser) {
                    Swal.fire({
                        title: 'Anda belum login',
                        text: 'Silahkan login terlebih dahulu untuk melakukan diagnosis',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Login',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}";
                        }
                    })
                } else if (!hasUserProfile) {
                    Swal.fire({
                        title: 'Anda belum melengkapi profil',
                        text: 'Silahkan lengkapi profil terlebih dahulu untuk melakukan diagnosis',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Lengkapi Profil',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('edit-profile') }}";
                        }
                    });
                } else {
                    function ajaxRequestToDiagnosis(element, jawaban) {
                        return $.ajax({
                            url: "{{ route('user.diagnosis') }}",
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
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
                                    modalResult(response[1], true, 'Penyakit ditemukan !',
                                        'Penyakit yang diderita adalah ' + response[1].name,
                                        'success');
                                    break;
                                } else if (response.penyakitUndentified) {
                                    modalResult(response.penyakitUndentified, false,
                                        'Penyakit tidak ditemukan !',
                                        'Penyakit yang di derita tidak ditemukan', 'error');
                                }
                            } catch (error) {
                                swalError(error.responseJSON);
                            }
                        }
                    }
                    showModal();
                }
            });

            if (isUser) {
                let login = @json(session('success') ?? false);
                if (login && !localStorage.getItem('notyfshown')) {
                    notyf.success(login);
                    localStorage.setItem('notyfshown', true);
                } else {
                    localStorage.removeItem('notyfshown');
                }
            }

            const btnNavLinkProfile = document.querySelector('#btnNavLinkProfile') ?? null;
            if (btnNavLinkProfile != null) {
                btnNavLinkProfile.addEventListener('click', async (e) => {
                    e.preventDefault();
                    modalEditProfileInstance.show();
                })
            }
        });
    </script>

    @stack('scriptSpecific')
@endpush
