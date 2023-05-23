<div class="modal fade" id="editProfileModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Profil</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="" class="row justify-content-center">
                    <div class="col-12 col-sm-10 py-5">
                        <div class="d-flex justify-content-between">
                            <h2 class="font-semibold pb-3">
                                Edit Profil
                            </h2>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('update-profile') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="row pb-3">
                                        <div class="col-lg-6 col-12">
                                            <label for="name" class="form-label font-medium">Nama</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="">
                                        </div>
                                        <div class="col-lg-6 col-12 pt-3 pt-sm-0">
                                            <label for="email" class="form-label font-medium">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                readonly value="">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label font-medium">Alamat</label>
                                        <textarea rows="3" id="address" name="address" class="form-control" id="exampleFormControlInput1">{{ old('address', $user->profile->address ?? null) }}</textarea>
                                    </div>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label font-medium">Provinsi</label>
                                                <select class="form-select select-custom" name="province" id="provinsi"
                                                    aria-label="Default select example">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label for="kota"
                                                    class="form-label font-medium">Kota/Kabupaten</label>
                                                <select disabled class="form-select select-custom" name="city"
                                                    id="kota" aria-label="Default select example">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="profesi" class="form-label font-medium">Profesi</label>
                                        <select class="form-select select-custom" name="profession" id="profesi"
                                            aria-label="Default select example">
                                            <option disabled selected>Pilih Profesi</option>
                                        </select>
                                    </div>
                                    <div class="pt-3 ">
                                        <div class="d-grid">
                                            <button type="submit" id="btnSubmitEditProfile"
                                                class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" id="historiDiagnosis">
                    <div class="col-12 col-sm-10 py-5">
                        <h2 class="font-semibold pb-3">
                            Histori Diagnosis
                        </h2>
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table table-striped text-nowrap" style="width: 100%;"
                                    id="historiDiagnosisTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Diagnosis Penyakit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center d-none" id="detailHistoriDiagnosis">
                    <div class="col-12 col-sm-10 py-5">
                        <h2 class="font-semibold pb-3">
                        </h2>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped  " id="detailHistoriDiagnosisTable">
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
                </div>
            </div>
        </div>
    </div>
</div>
