<div class="modal fade" id="detailDiagnosisModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h1 id="headerDetailDiagnosis" class="font-semibold text-center pt-5 d-none">
                    </h1>
                    <p id="subheaderDetailDiagnosis" class="h3 font-normal text-center d-none">
                    </p>
                    <div class="row pt-5" id="rowDetailPenyakit">
                        <div class="col-12">
                            <h2 class="font-semibold">
                                Detail Penyakit
                            </h2>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 pt-5 pt-lg-0 order-1">
                                            <div class="pb-3">
                                                <h3 class="h4 ">Nama Penyakit</h3>
                                                <p class="card-text" id="penyakitName">
                                                </p>
                                            </div>
                                            <div class="pb-3">
                                                <h3 class="h4 ">Penyebab Penyakit</h3>
                                                <p class="card-text" id="penyakitReason">
                                                </p>
                                            </div>
                                            <div>
                                                <h3 id="headerPenyakitSolution" class="h4">Solusi Penyakit</h3>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 col-lg-4 order-lg-2 d-flex align-items-center justify-content-center">
                                            <div class="container-image-penyakit"
                                                id="containerImagePenyakitDetailDiagnosisModal"
                                                style="max-width: 350px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row py-5">
                        <h2 class="font-semibold">
                            Histori Jawaban
                        </h2>
                        <div class="card shadow" style="max-height: 400px; overflow-y: scroll">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="detailJawabanDiagnosisTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Gejala</th>
                                                <th scope="col">Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <h2 class="font-semibold">
                            Persentase Penyakit
                        </h2>
                        <div class="card shadow">
                            <div class="card-body">
                                <canvas id="chartDiagnosisPenyakit" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
