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
                                Sistem ini menggunakan metode forward chaining dalam mendiagnosis penyakit. Prosesnya
                                dimulai dengan evaluasi gejala yang diberikan oleh pengguna, kemudian
                                sistem akan mencocokkan dengan aturan yang ada. Jika terdapat aturan yang telah terpenuhi,
                                sistem akan memberikan hasil diagnosis penyakit. Hasil diagnosis penyakit akan disimpan di
                                dalam sistem. Pengguna dapat melihat histori hasil diagnosis beserta
                                bobot tiap gejala yang telah diberikan. Setelah mengetahui penyakit, pengguna dapat
                                mengunjungi halaman bagian Daftar Penyakit untuk melihat informasi lebih lanjut.
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
                        <ul class="nav nav-pills mb-3 d-flex justify-content-start" id="pills-tab" role="tablist">
                            @foreach ($penyakit as $p)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $p->id }}-tab" data-bs-toggle="pill"
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
    @if (auth()->check())
        @section('title', 'User ' . html_entity_decode('&mdash;'))
        @include('user.profile-modal')
        @push('scriptPerPage')
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
            <script>
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
                            await new Promise(resolve => setTimeout(resolve, 1000)); // Delay selama 1 detik
                            const swalSuccess = await Swal.fire({
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
                        if (response.user.profile == null) {
                            response.user.profile = {
                                address: '',
                                province: '',
                                city: '',
                                profession: ''
                            }
                        }
                        setElementAttributes(elements.nameInput, response.user.name);
                        setElementAttributes(elements.emailInput, response.user.email);
                        setElementAttributes(elements.addressTextarea, response.user.profile.address);

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
                            if (error.status == 404) {
                                elements.kotaSelect.innerHTML =
                                    '<option value="">Pilih Provinsi Terlebih Dahulu</option>';
                            } else {
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
            </script>
        @endpush
        @push('stylePerPage')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        @endpush
    @endif
@endsection

@push('scriptPerPage')
    <script type="text/javascript">
        const isUser = @json(Auth::check());
        const hasUserProfile = @json(Auth::user()->profile->id ?? false);
        let login = @json(session('success') ?? false);
        const csrfToken = '{{ csrf_token() }}';
        const penyakitImage = @json($penyakit);
        const assetStorage = '{{ asset('/storage/penyakit/') }}';
    </script>
@endpush
