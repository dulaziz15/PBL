function indexAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneMahasiswa&id=' + id,
        success: function(data) {   
            if (data == false) {
                $("#modal-tambah-ta-mahasiswa").css("display: block;");
                $(".card-main").css('display', 'none');
            } else {
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
    
                $.ajax({
                    type: 'GET',
                    url: '/Pbl/routes/route.php?page=tugasakhir&sub=getByTugasAkhir&id=' + data.tugas_akhir_id,
                    success: function(data) {
                        if (Array.isArray(data)) {
                            let tableContent = '';
                            data.forEach(tugas_akhir => {
                                tableContent += `
                                    <tr>
                                    <td>${tugas_akhir.bagian}</td>
                                    <td>${tugas_akhir.nama_file}</td>
                                    <td>
                                    <div>
                                        <a class="status ${tugas_akhir.status_dokumen_ta == 'Approved' ? 'status-verify' : 'status-revisi'}">
                                            <i class="fa-solid ${tugas_akhir.status_dokumen_ta == 'Approved' ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                                                <span>${tugas_akhir.status_dokumen_ta == 'Approved' ? 'Verifiy' : 'Revisi'}</span>
                                                </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="edit_dokumen.php?id=${tugas_akhir.dokumen_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                                        <a href="show_dokumen.php?id=${tugas_akhir.dokumen_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                                    </td>
                                    </tr>
                                `;
                            });
                            $('#dataTugasAkhirMahasiswa').html(tableContent);
                            $('.list-dokumen-ta-mahasiswa').DataTable({
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
            }
        }
    });
    
    
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getAll',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(tugas_akhir => {
                    tableContent += `
            <tr>
            <td>${tugas_akhir.nama}</td>
            <td>${tugas_akhir.NIM}</td>
            <td>${tugas_akhir.judul}</td>
            <td>
                <div>
                <a class="status ${tugas_akhir.status_tugas_akhir == 'Approved' ? 'status-verify' : (tugas_akhir.status_tugas_akhir == 'Pending' ? 'status-revisi' : 'status-rejected')}">
                    <i class="fa-solid ${tugas_akhir.status_tugas_akhir == 'Approved' ? 'fa-circle-check' : tugas_akhir.status_tugas_akhir == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${tugas_akhir.status_tugas_akhir == 'Approved' ? 'Verifiy' : tugas_akhir.status_tugas_akhir == 'Pending' ? 'Revisi' : 'Rejected'}</span>
                        </a>
                </div>
            </td>
            <td>
                <a href="show.php?id=${tugas_akhir.tugas_akhir_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                <a href="edit.php?id=${tugas_akhir.tugas_akhir_id}" rel="modal:open" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                <a href="../../routes/route.php?page=tugasakhir&sub=hapus&id=${tugas_akhir.tugas_akhir_id}" onclick="return confirm('Apakah anda yakin ingin menghapus data Tugas Akhir dengan judul ${tugas_akhir.judul} ?')" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
            </td>
            </tr>
        `;
                });
                $('#dataTugasAkhir').html(tableContent);
                $('.list-ta').DataTable({
                    paging: true, // Menampilkan paginasi
                    searching: true, // Mengaktifkan pencarian
                    ordering: true, // Mengaktifkan sorting
                    info: true, // Menampilkan informasi tabel
                    autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                    responsive: true, // Menyusun ulang kolom secara responsif di perangkat mobile
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
    
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=getByUser&id=' + id,
        success: function(data) {
            $("#mahasiswa_tambah_ta").val(data.mahasiswa_id + ":" + data.NIM);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}