<nav class="navbar fixed-top navbar-expand-lg bg-body-transparent" data-aos="fade-down">
    <div class="container">
        <a class="navbar-brand font-semibold pe-none" href="#">
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
                <li class="nav-item">
                    <a class="nav-link beranda" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link diagnosis" href="#diagnosis">Diagnosa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link penyakit" href="#penyakit">Informasi Penyakit</a>
                </li>
            </ul>
            @if (Auth::check() && Auth::user()->email_verified_at != null && Gate::check('asUser'))
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
                        <form action="{{ route('logout') }}" method="POST" id="formLogout" hidden
                            style="display: none">
                            @csrf
                        </form>
                    </li>
                    @push('scriptPerPage')
                        <script type="text/javascript">
                            const buttonLogout = document.getElementById('btnLogout');
                            buttonLogout.addEventListener('click', function(e) {
                                e.preventDefault();
                                document.getElementById('formLogout').submit();
                            });
                        </script>
                    @endpush
                </ul>
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
            @endif
        </div>
    </div>
</nav>
