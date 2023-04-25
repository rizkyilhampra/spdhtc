<!-- Modal -->
<div class="modal fade" id="diagnosisModal" tabindex="-1" aria-labelledby="diagnosisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="diagnosisModalLabel">Diagnosis</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                <p class="font-medium fs-3 text-center">
                    {{ $gejala->first()->name }}
                </p>
            </div>
            <div class="modal-footer ">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
                <div class="row w-100">
                    <div class="col-6">
                        <button class="btn btn-secondary w-100 btn-lg font-semibold"
                            onclick="submitJawaban({{ $gejala[10]->id }},0)">
                            Tidak
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100 btn-lg font-semibold"
                            onclick="submitJawaban({{ $gejala[10]->id }},1)">
                            Iya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scriptSpecific')
    <script>
        $(document).ready(function() {
            const allGejala = @json($gejala);
            const currentGejala = @json($gejala);

            console.log(allGejala);
            console.log(currentGejala);
        });

        function submitJawaban(id, jawaban) {
            $.ajax({
                url: "{{ route('user.diagnosis') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    idgejala: id,
                    value: jawaban
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        if (response.data == 'done') {
                            console.log(response.data);
                        } else {
                            $('#diagnosisModal').modal('hide');
                            $('#diagnosisModal').on('hidden.bs.modal', function(e) {
                                $('#diagnosisModal').modal('show');
                            });
                        }
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@endpush
