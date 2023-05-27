@extends('layouts.user.app')
@section('title', 'SPDHTC')
@section('content')
    <div id="beranda" class="row min-vh-100 align-content-center section">
        <div class="col-12 col-md-6 py-5 " data-aos="fade-right" id="col1">
            @php
                $image = 'gambar-cabai.jpg';
                [$width, $height] = getimagesize(public_path('assets/img/' . $image));
            @endphp
            <img class="img-fluid bg-body-tertiary rounded" id="gambar-cabai" width="{{ $width }}"
                height="{{ $height }}" src="{{ asset('assets/img/gambar-cabai.jpg') }}"
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
                            <button id="btn-diagnosis" class="btn btn-custom1 font-medium py-2">
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
                <ul class="nav nav-pills mb-3 d-flex justify-content-start" id="pills-tab" role="tablist">
                    @foreach ($penyakit as $p)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link font-medium" id="pills-{{ $p->id }}-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-{{ $p->id }}" type="button" role="tab"
                                aria-controls="pills-{{ $p->id }}" aria-selected="false">
                                {{ $p->name }}
                            </button>
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
                                        <div class="col-12 col-lg-8 pt-5 pt-lg-0 order-1">
                                            <div class="pb-3">
                                                <h3 class="font-medium">Nama Penyakit</h3>
                                                <p class="card-text">
                                                    {{ $p->name }}
                                                </p>
                                            </div>
                                            <div class="pb-3">
                                                <h3 class="font-medium">Penyebab Penyakit</h3>
                                                <p class="card-text">
                                                    {{ $p->reason }}
                                                </p>
                                            </div>
                                            <div>
                                                <h3 class="font-medium ">Solusi Penyakit</h3>
                                                <p class="card-text">
                                                    @php
                                                        $solusi = $p->solution;
                                                        preg_match_all('/(\d+\.)\s*(.*?)(?=(\d+\.|$))/s', $solusi, $matches);
                                                        $nomorAsOlTag = '<ol>';
                                                        for ($i = 0; $i < count($matches[0]); $i++) {
                                                            $nomorAsOlTag .= '<li>' . $matches[2][$i] . '</li>';
                                                        }
                                                        $nomorAsOlTag .= '</ol>';
                                                        echo $nomorAsOlTag;
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                        @php
                                            $image = $p->image;
                                            [$width, $height] = getimagesize(storage_path('app/public/penyakit/' . $image));
                                        @endphp

                                        <div class="col-12 col-lg-4 order-lg-2 d-flex align-items-center justify-content-center"
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
            <div class="col-12 col-md-5 pb-4" data-aos="fade-right" data-bs-anchor="#kontak">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="font-medium pb-3 card-title">
                            Pengembang
                        </h3>
                        <div class="row">
                            <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center pb-4 pb-lg-0">
                                <img src="{{ asset('assets/img/logo-poliban.png') }}" class="img-fluid" id="logo-poliban"
                                    alt="logo poliban" width="150" height="137" srcset="" data-bs-toggle="tooltip"
                                    data-bs-title="Logo POLIBAN">
                            </div>
                            <div class="col-12 col-lg-8 d-flex justify-content-center align-items-center">
                                <div class="d-inline">
                                    <p class="text-center font-medium mb-2">Muhammad Rizky Ilham Pratama</p>
                                    <div class="d-flex justify-content-center pb-4">
                                        <a class="btn btn-outline-dark me-2" target="_blank"
                                            href="mailto::rizkyilhamp16@gmail.com" data-bs-toggle="tooltip"
                                            data-bs-title="rizkyilhamp16@gmail.com">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </a>
                                        <a class="btn btn-outline-dark " target="_blank"
                                            href="https://instagram.com/rizkyilhampra" data-bs-toggle="tooltip"
                                            data-bs-title="@rizkyilhampra">
                                            <i class="fa-brands fa-instagram"></i>
                                            Instagram
                                        </a>
                                    </div>
                                    <p class="text-center font-medium  mb-2">Muhammad Rizaldy Fauzan</p>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-outline-dark me-2" target="_blank" href="#"
                                            data-bs-toggle="tooltip" data-bs-title="fauzanrizaldy24@gmail.com">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </a>
                                        <a class="btn btn-outline-dark " target="_blank"
                                            href="https://instagram.com/_zaldyfauzan/" data-bs-toggle="tooltip"
                                            data-bs-title="@_zaldyfauzan">
                                            <i class="fa-brands fa-instagram"></i>
                                            Instagram
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7" data-aos="fade-left" data-bs-anchor="#kontak">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="font-medium pb-2 card-title">
                            Tentang Kami
                        </h3>
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

@push('scriptPerPage')
    <script type="text/javascript">
        const isUser = @json(Auth::check());
        const hasUserProfile = @json(Auth::user()->profile->id ?? false);
        let btnDiagnosis2 = document.querySelector('#btn-diagnosis');
        const csrfToken = '{{ csrf_token() }}';
        let login = @json(session('success') ?? false);
    </script>
@endpush
