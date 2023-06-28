@extends('layouts.user.app')
@section('content')
    <div id="beranda" class=" section">
        <div class="container">
            <div class="row min-vh-100 min-vh-u-lg-85 align-content-center">
                <div class="col-12 col-lg-6 py-5" data-aos="fade-right" id="container-image-hero">
                    <img class="img-fluid bg-body-tertiary rounded" id="gambar-cabai"
                        src="{{ asset('assets/img/gambar-cabai.webp') }}" width="1280" height="853"
                        alt="Gambar Cabai https://fumida.co.id/wp-content/uploads/2021/03/67.-membasmi-hama-cabai.jpg">
                </div>
                <div class="col-12 col-lg-6 align-self-center px-3 px-sm-5" data-aos="fade-left" data-aos-anchor="body"
                    id="col2">
                    <h1 class="text-start font-bold ">
                        Sistem Pakar Diagnosis Penyakit Tanaman Cabai
                    </h1>
                    <p class="lead">Temukan penyakit yang menyerang tanaman cabai anda serta ketahui penyebab dan solusi
                        pengendaliannya. Daftar sekarang lalu mulai diagnosis untuk hasil panen yang lebih baik!</p>
                </div>
            </div>
        </div>
    </div>
    <div id="diagnosis" class="section">
        <div class="container">
            <h2 class="font-semibold pb-3" data-aos="fade-up">
                Diagnosis
            </h2>
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <div class="card shadow border border-0">
                        <div class="card-body">
                            <div class="card-text">
                                Sistem ini menggunakan metode forward chaining untuk mendiagnosis penyakit. Proses dimulai
                                dengan mengevaluasi gejala yang diberikan oleh pengguna, kemudian sistem mencocokkannya
                                dengan aturan yang ada. Jika terdapat aturan yang terpenuhi, sistem akan memberikan detail
                                hasil diagnosis penyakit. Detail hasil diagnosis penyakit akan disimpan dalam sistem.
                                Pengguna dapat melihat kembali detail hasil diagnosis yang telah dilakukan pada histori
                                diagnosis di menu profil.
                            </div>
                            <div class="d-grid pt-3">
                                <button id="btn-diagnosis" class="btn btn-custom1 py-2">
                                    Mulai Diagnosis Penyakit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="penyakit" class=" section">
        <div class="container">
            <h2 class="fw-semibold" data-aos="fade-up">
                Daftar Penyakit Tanaman Cabai
            </h2>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body border border-0 shadow p-3 mt-3" data-aos="fade-up">
                        <ul class="nav nav-pills mb-3 d-flex flex-column flex-md-row" id="pills-tab" role="tablist">
                            @foreach ($penyakit as $p)
                                <li class="nav-item" role="presentation">
                                    <div class="d-grid py-1 py-md-0">
                                        <button class="nav-link" id="pills-{{ $p->id }}-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-{{ $p->id }}" type="button" role="tab"
                                            aria-controls="pills-{{ $p->id }}" aria-selected="false">
                                            {{ $p->name }}
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @foreach ($penyakit as $p)
                                <div class="tab-pane fade" id="pills-{{ $p->id }}" role="tabpanel"
                                    aria-labelledby="pills-{{ $p->id }}-tab" tabindex="0">
                                    <div class="card border border-start-0 border-end-0 border-bottom-0 border-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-lg-8 pt-5 pt-lg-0 order-1">
                                                    <div class="pb-3">
                                                        <h3 class="h4 ">Nama Penyakit</h3>
                                                        <p class="card-text">
                                                            {{ $p->name }}
                                                        </p>
                                                    </div>
                                                    <div class="pb-3">
                                                        <h3 class="h4 ">Penyebab Penyakit</h3>
                                                        <p class="card-text">
                                                            {{ $p->reason }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h3 class="h4 ">Solusi Penyakit</h3>
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
                                                    </div>
                                                </div>
                                                @php
                                                    $image = $p->image;
                                                    [$width, $height] = getimagesize(storage_path('app/public/penyakit/' . $image));
                                                @endphp
                                                <div class="col-12 col-lg-4 order-lg-2 d-flex align-items-center justify-content-center"
                                                    id="column-img-penyakit">
                                                    <div class="container-image-penyakit">
                                                        <div class="container-chocolat">
                                                            <a href="#" class="open-image-chocolat">
                                                                <img width="{{ $width }}"
                                                                    height="{{ $height }}"
                                                                    class="img-fluid chocolat-image"
                                                                    title="{{ $p->name }}"
                                                                    src="{{ asset('/storage/penyakit/' . $p->image) }}"
                                                                    alt="{{ $p->name }}" srcset="" loading="lazy"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-title="Gambar {{ $p->name }}">
                                                            </a>
                                                        </div>
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
        </div>
    </div>

    @if (Auth::check() && Auth::user()->email_verified_at != null && Gate::check('asUser'))
        @section('title', auth()->user()->name . html_entity_decode(' &mdash;'))
        @include('user.profile-modal')
        @include('user.detail-diagnosis-modal')
        @push('styleLibraries')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        @endpush
        @push('scriptPerPage')
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="{{ asset('assets/chart.js/dist/Chart.min.js') }}"></script>
            <script src="{{ asset('spesified-assets/user/profile-modal.js') }}"></script>
            <script src="{{ asset('spesified-assets/user/detail-diagnosis-modal.js') }}"></script>
        @endpush
    @endif
@endsection

@push('scriptPerPage')
    <script type="text/javascript">
        const isUser = @json(Auth::check() && Auth::user()->email_verified_at != null && Gate::check('asUser'));
        const hasUserProfile = @json(Auth::user()->profile->id ?? false);
        let login = @json(session('success') ?? false);
        const csrfToken = '{{ csrf_token() }}';
        const penyakitImage = @json($penyakit);
        const assetStoragePenyakit = '{{ asset('/storage/penyakit/') }}';
        const assetStorageGejala = '{{ asset('/storage/gejala/') }}';
    </script>
@endpush
