$.ajax({
    type: 'GET',
    url: '/Pbl/routes/route.php?page=arsip&sub=getAllVerify',
    success: function(data) {
        if (Array.isArray(data)) {
            let tableContent = '';
            data.forEach(dokumen => {
                tableContent += `
                <tr>
                <td>${dokumen.NIM}</td>
                <td>${dokumen.nama}</td>
                <td>
                    <a href="show_ta.php?id=${dokumen.tugas_akhir_id}" rel="modal:open" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show Dokumen TA</span></a>
                    <a href="show.php?id=${dokumen.tugas_akhir_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show Dokumen Pendukung</span></a>
                    <a href="../../routes/route.php?page=bebastanggungan&sub=downloadBebasTanggungan&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan == "Approved" ? '' : 'style="display:none;"'} class="btn btn-download"><i class="fa-solid fa-download"></i><span>Download Bebas Tanggungan</span></a>
                </td>
                </tr>
            `;
            });
            $('#dataArsip').html(tableContent);
            $('.table-bebas-tanggungan').DataTable({
                paging: true, // Menampilkan paginasi
                searching: true, // Mengaktifkan pencarian
                ordering: true, // Mengaktifkan sorting
                info: true, // Menampilkan informasi tabel
                autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                }
            });
        } else {
            console.error("Expected an array but received:", data);
        }
    },
    error: function(xhr, status, error) {
        console.error("AJAX request failed:", status, error);
    }
});
