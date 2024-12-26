function showAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOne&id=' + id,
        success: function (data) {
            // console.log(data);
            $("#status_project").append(`<div>
                <a class="status ${data.status_tugas_akhir == 'Approved' ? 'status-verify' : data.status_tugas_akhir == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${data.status_tugas_akhir == 'Approved' ? 'fa-circle-check' : data.status_tugas_akhir == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${data.status_tugas_akhir == 'Approved' ? 'Verifiy' : data.status_tugas_akhir == 'Pending' ? 'Revisi' : 'Rejected'}</span>
                        </a>
                </div>`);
            $("#data_tugas_akhir").append(`
                <li><span>NAMA : </span>${data.nama}</li>
                <li><span>NIM : </span>${data.NIM}</li>
                <li><span>JUDUL : </span>${data.judul}</li>
            `);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
    
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOne&id=' + id,
        success: function (data) {
            console.log(data);
            $("#data").html(`<p>${data.judul}</p>`);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
    
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getByTugasAkhir&id=' + id,
        success: function (data) {
            console.log(data);
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(tugas_akhir => {
                    tableContent += `
            <tr>
            <td>${tugas_akhir.bagian}</td>
            <td>${tugas_akhir.nama_file}</td>
            <td>
            <div>
                <a class="status ${tugas_akhir.status_dokumen_ta == 'Approved' ? 'status-verify' : tugas_akhir.status_dokumen_ta == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${tugas_akhir.status_dokumen_ta == 'Approved' ? 'fa-circle-check' : tugas_akhir.status_dokumen_ta == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${tugas_akhir.status_dokumen_ta == 'Approved' ? 'Verifiy' : tugas_akhir.status_dokumen_ta == 'Pending' ? 'Pending' : 'Rejected'}</span>
                </a>
                </div>
            </td>
            <td>
                <a href="../../routes/route.php?page=tugasakhir&sub=verifikasi&id=${tugas_akhir.dokumen_id}" onclick=" return confirm('Pastikan semua catatan sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                <a href="edit_dokumen.php?id=${tugas_akhir.dokumen_id}" rel="modal:open" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                <a href="show_dokumen.php?id=${tugas_akhir.dokumen_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
            </td>
            </tr>
        `;
                });
                $('#dataTugasAkhir').html(tableContent);
                $('table').DataTable();
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}