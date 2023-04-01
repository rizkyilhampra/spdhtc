<div id="penyakit" class="row section">
    <div class="col-12">
        <h2 class="fw-semibold">
            Daftar Penyakit Tanaman Cabai
        </h2>
        <div class="card card-body shadow p-3 mt-3">
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


@section('scriptPerPage')
    <script>
        $(document).ready(function() {
            $('#pills-1-tab').addClass('active');
            $('#pills-1').addClass('show active');
        })
    </script>
@endsection
