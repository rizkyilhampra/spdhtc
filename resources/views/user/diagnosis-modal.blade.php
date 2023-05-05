@foreach ($gejala as $g)
    <div class="modal fade" id="diagnosisModal-{{ $g->id }}" id-gejala="{{ $g->id }}" tabindex="-1"
        aria-labelledby="diagnosisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="diagnosisModalLabel">Pertanyaan</h1>
                </div>
                <div class="modal-body">
                    <p class="font-medium fs-3 text-center">
                        Apakah terdapat {{ $g->name }} ?
                    </p>
                </div>
                <div class="modal-footer ">
                    <div class="row w-100">
                        <div class="col-6">
                            <button id="buttonFalseModal" class="btn btn-secondary w-100 btn-lg font-semibold">
                                Tidak
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="buttonTrueModal" id-gejala={{ $g->id }}
                                class="btn btn-primary w-100 btn-lg font-semibold">
                                Iya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
