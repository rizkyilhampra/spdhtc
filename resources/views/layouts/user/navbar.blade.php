<nav class="navbar fixed-top navbar-expand-lg bg-body-transparent" data-aos="fade-down" data-aos-anchor="body">
    <div class="container-fluid">
        <a class="navbar-brand font-semibold" href="#">
            {{-- <svg class="d-inline-block align-text-top" width="30" height="24" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
            </svg> --}}
            <div class="d-inline-block">
                <i class="d-flex justify-content-center fa-solid fa-user-doctor fa-bounce"
                    style="height: 24px; width: 30px"></i>
            </div>
            SPDHTC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 font-medium">
                {{-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Diagnosis Penyakit Tanaman
                            Cabai</a>
                    </li> --}}
                <li class="nav-item">
                    <a class="nav-link beranda" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link diagnosis" href="#diagnosis">Diagnosa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link penyakit" href="#penyakit">Informasi Penyakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link kontak" href="#kontak">Kontak</a>
                </li>
            </ul>
            @can('asUser')
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('edit-profile') }}" class="nav-link" id="btnNavLinkProfile">
                            <div class="d-grid">
                                <button class="btn btn-outline-dark font-medium text-start">
                                    <i class="fa-solid fa-user pe-2"></i>
                                    Profil
                                </button>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" id="btnLogout" class="nav-link">
                            <div class="d-grid">
                                <button class="btn btn-outline-dark font-medium text-start">
                                    <i class="fa-solid fa-right-from-bracket pe-2"></i>
                                    Keluar
                                </button>
                            </div>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="formLogout" hidden style="display: none">
                            @csrf
                        </form>
                    </li>

                </ul>
                @push('scriptPerPage')
                    <script type="text/javascript">
                        const buttonLogout = document.getElementById('btnLogout');
                        buttonLogout.addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('formLogout').submit();
                        });
                    </script>
                @endpush
            @else
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <div class="d-grid">
                                <button class="btn btn-outline-dark font-medium text-start">
                                    <i class="fa-solid fa-right-to-bracket pe-2"></i>
                                    Masuk/Daftar
                                </button>
                            </div>
                        </a>
                    </li>
                </ul>
            @endcan
        </div>
    </div>
</nav>
