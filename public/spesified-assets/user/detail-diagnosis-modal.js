const detailDiagnosisModal = document.querySelector('#detailDiagnosisModal');
const titleDetailDiagnosisModal = detailDiagnosisModal.querySelector('.modal-title');
const instanceDetailDiagnosisModal = bootstrap.Modal.getOrCreateInstance(detailDiagnosisModal);
const headerDetailDiagnosis = document.getElementById('headerDetailDiagnosis');
const subheaderDetailDiagnosis = document.getElementById('subheaderDetailDiagnosis');
const containerImagePenyakitDetailDiagnosisModal = document.getElementById('containerImagePenyakitDetailDiagnosisModal');
const headerPenyakitSolution = document.getElementById('headerPenyakitSolution');
const rowDetailPenyakit = document.getElementById('rowDetailPenyakit');
const detailJawabanDiagnosisTable = document.getElementById('detailJawabanDiagnosisTable');
const tableBody = detailJawabanDiagnosisTable.querySelector('tbody');

let idPenyakit = null;
let idDiagnosis = null;
let noHistoriDiagnosis = null;
let diagnosed = false;
let penyakitUndentified = false;

function getPenyakitIdFromHistori(data, no) {
    idDiagnosis = data;
    noHistoriDiagnosis = no;
    diagnosed = false;
    instanceDetailDiagnosisModal.show();
}

function getPenyakitFromDiagnose(data, wasDiagnosed) {
    idPenyakit = data.idPenyakit;
    idDiagnosis = data.idDiagnosis;
    diagnosed = wasDiagnosed;
    instanceDetailDiagnosisModal.show();
}

function getUndentifiedPenyakit(data) {
    penyakitUndentified = data;
    instanceDetailDiagnosisModal.show();
}

function ajaxRequestDetailDiagnosis() {
    return $.ajax({
        url: '/detail-diagnosis',
        method: 'GET',
        data: {
            id_penyakit: idPenyakit,
            id_diagnosis: idDiagnosis,
        },
    });
}

detailDiagnosisModal.addEventListener('show.bs.modal', async () => {
    try {
        let response = await ajaxRequestDetailDiagnosis();
        drawDetailDiagnosis(response, diagnosed);
        drawDetailJawabanDiagnosis(response.answerLog);
    } catch (error) {
        swalError(error.responseJSON);
    }
});


function drawDetailDiagnosis(response, wasDiagnosed) {
    if (wasDiagnosed) {
        titleDetailDiagnosisModal.innerText = 'Detail Diagnosis';
        headerDetailDiagnosis.innerText = "Penyakit Ditemukan!";
        subheaderDetailDiagnosis.innerHTML = "Penyakit yang diderita adalah " + `<u>${response.penyakit.name}</u>`;
        headerDetailDiagnosis.classList.remove('d-none');
        subheaderDetailDiagnosis.classList.remove('d-none');
    }
    titleDetailDiagnosisModal.innerText = 'Detail Diagnosis No. ' + noHistoriDiagnosis;
    if (response.penyakit == null || penyakitUndentified) {
        headerDetailDiagnosis.innerText = "Penyakit Tidak Ditemukan!";
        subheaderDetailDiagnosis.innerHTML = 'Tidak ada penyakit yang cocok dengan gejala yang anda masukkan.';
        headerDetailDiagnosis.classList.remove('d-none');
        subheaderDetailDiagnosis.classList.remove('d-none');
        rowDetailPenyakit.classList.add('d-none');
    } else {
        if (rowDetailPenyakit.classList.contains('d-none')) {
            rowDetailPenyakit.classList.remove('d-none');
        }
        const penyakitName = document.getElementById('penyakitName');
        const penyakitReason = document.getElementById('penyakitReason');
        penyakitName.innerHTML = response.penyakit.name;
        penyakitReason.innerHTML = response.penyakit.reason;

        let penyakitSolution = response.penyakit.solution;
        let regex = /(\d+\.)\s*(.*?)(?=(\d+\.|$))/gs;
        let matches = [...penyakitSolution.matchAll(regex)];
        let nomorAsOlTag = '<ol>';
        for (let i = 0; i < matches.length; i++) {
            nomorAsOlTag += '<li>' + matches[i][2] + '</li>';
        }
        nomorAsOlTag += '</ol>';
        headerPenyakitSolution.insertAdjacentHTML('afterend', nomorAsOlTag);

        const imagePenyakit = new Image();
        imagePenyakit.src = assetImageUrl + '/' + response.penyakit.image;
        imagePenyakit.alt = response.penyakit.name;
        imagePenyakit.classList.add('img-fluid');
        containerImagePenyakitDetailDiagnosisModal.appendChild(imagePenyakit);
    }
}

function drawDetailJawabanDiagnosis(data) {
    const response = data;
    response.forEach((item, index) => {
        const tableRow = document.createElement('tr');
        const tableData = document.createElement('td');
        const tableData2 = document.createElement('td');
        const tableData3 = document.createElement('td');
        let number = index + 1;
        tableData.innerHTML = number;
        tableData2.innerHTML = item.name;
        tableData3.innerHTML = item.answer;
        tableRow.appendChild(tableData);
        tableRow.appendChild(tableData2);
        tableRow.appendChild(tableData3);
        tableBody.appendChild(tableRow);
    });
}

detailDiagnosisModal.addEventListener('hide.bs.modal', function (event) {
    containerImagePenyakitDetailDiagnosisModal.innerHTML = '';
    if (headerPenyakitSolution.nextElementSibling) {
        headerPenyakitSolution.nextElementSibling.remove();
    }
    headerDetailDiagnosis.classList.add('d-none');
    subheaderDetailDiagnosis.classList.add('d-none');

    //remove all child element in table body
    while (tableBody.firstChild) {
        tableBody.removeChild(tableBody.firstChild);
    }
});