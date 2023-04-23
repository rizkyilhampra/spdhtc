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
                                    <div class="row-auto pb-3">
                                        <h6 class="card-title font-medium">
                                            Nama Penyakit
                                        </h6>
                                        <p class="card-text">
                                            {{ $p->name }}
                                        </p>
                                    </div>
                                    <div class="row-auto pb-3">
                                        <h6 class="card-title font-medium">
                                            Penyebab Penyakit
                                        </h6>
                                        <p class="card-text">
                                            {{ $p->reason }}
                                        </p>
                                    </div>
                                    <div class="row-auto pb-3">
                                        <h6 class="card-title font-medium">
                                            Solusi Penyakit
                                        </h6>
                                        <p class="card-text">
                                            {{ $p->solution }}
                                        </p>
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
    @if (Auth::check())
        @include('user.diagnosis-modal')
        @include('user.profile-modal')
    @endif
@endsection

@push('stylePerPage')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="{{ asset('/spesified-assets/aos.css') }}" />
@endpush

@push('scriptPerPage')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js" type="text/javascript">
    </script>
    <script src="{{ asset('/spesified-assets/aos.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        function buttonToTop(top) {
            let button = $('#upScroll');
            if (top) {
                return button.addClass('show');
            } else {
                return button.removeClass('show');
            }
        }
        $(document).ready(function() {
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

            const btnBeranda = document.querySelector('.beranda');
            const btnDiagnosis = document.querySelector('.diagnosis');
            const btnPenyakit = document.querySelector('.penyakit');
            const btnKontak = document.querySelector('.kontak');
            const allBtn = [btnBeranda, btnDiagnosis, btnPenyakit, btnKontak];
            allBtn.forEach((btn) => {
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

            const asUser = @json(Auth::check());
            const hasUserProfile = @json(Auth::user()->profile->id ?? false);
            let btnDiagnosis2 = document.querySelector('#btn-diagnosis')

            btnDiagnosis2.addEventListener('click', function(e) {
                e.preventDefault();
                if (!asUser) {
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
                    let modal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                        keyboard: false
                    });

                    modal.show();
                }
            });


            if (asUser) {
                let login = @json(session('success') ?? false);
                if (login && !localStorage.getItem('notyfshown')) {
                    notyf.success(login);
                    localStorage.setItem('notyfshown', true);
                } else {
                    localStorage.removeItem('notyfshown');
                }
            }
        });
    </script>

    @stack('scriptSpecific')
@endpush
