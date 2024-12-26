function indexAjax(id) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getAll',
        success: function(data) {
            if(data == false) {
                $(".table-bebas-tanggungan").html(`<h2>Data Bebas Tanggungan Kosong</h2>`);
            } else {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(dokumen => {
                    tableContent += `
                    <tr>
                    <td>${dokumen.NIM}</td>
                    <td>${dokumen.nama}</td>
                    <td>${dokumen.no_surat}</td>
                    <td><div>
                <a class="status ${dokumen.status_bebas_tanggungan == 'Approved' ? 'status-verify' : 'status-revisi'}">
                    <i class="fa-solid ${dokumen.status_bebas_tanggungan == 'Approved' ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                        <span>${dokumen.status_bebas_tanggungan == 'Approved' ? 'Available' : 'Pending'}</span>
                        </a>
                </div></td>
                    <td>
                        <a href="../../routes/route.php?page=bebastanggungan&sub=verifikasi&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan != "Approved" ? '' : 'style="display:none;"'} onclick=" return confirm('Pastikan semua Dokumen sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                        <a href="../../routes/route.php?page=bebastanggungan&sub=downloadBebasTanggungan&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan == "Approved" ? '' : 'style="display:none;"'} class="btn btn-download"><i class="fa-solid fa-download"></i><span>Download</span></a>
                        <a href="../../routes/route.php?page=bebastanggungan&sub=hapus&id=${dokumen.bebas_tanggungan_id}" onclick="return confirm('Apakah anda yakin ingin menghapus data Bebas Tanggungan dengan nama ${dokumen.nama} ?')" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                    </td>
                    </tr>
                `;
                });
                $('#dataDokumen').html(tableContent);
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
        }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
    
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getOneMahasiswa&id=' + id,
        success: function(data) {
            if (data == false) {
                $(".kosong").html(`<h1>Tugas Akhir anda belum terverifikasi !!</h1>`);
                $(".card-main").css('display', 'none');
            } else {
                $(".kosong").html(`<a href="tambah.php" class="btn btn-tambah">Tambah</a>`);
                $("#status_project").append(`<div>
                <a class="status ${data.status_bebas_tanggungan == 'Approved' ? 'status-verify' : data.status_bebas_tanggungan == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${data.status_bebas_tanggungan == 'Approved' ? 'fa-circle-check' : data.status_bebas_tanggungan == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${data.status_bebas_tanggungan == 'Approved' ? 'Verifiy' : data.status_bebas_tanggungan == 'Pending' ? 'Pending' : 'Rejected'}</span>
                        </a>
                </div>`);
                $("#status_ta").append(`<div>
                <a class="status ${data.status_tugas_akhir == 'Approved' ? 'status-verify' : data.status_tugas_akhir == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${data.status_tugas_akhir == 'Approved' ? 'fa-circle-check' : data.status_tugas_akhir == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${data.status_tugas_akhir == 'Approved' ? 'Verifiy' : data.status_tugas_akhir == 'Pending' ? 'Pending' : 'Rejected'}</span>
                        </a>
                </div>`);
                $("#status_dokumen").append(`<div>
                <a class="status ${data.status_dokumen_pendukung == 'Approved' ? 'status-verify' : data.status_dokumen_pendukung == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${data.status_dokumen_pendukung == 'Approved' ? 'fa-circle-check' : data.status_dokumen_pendukung == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${data.status_dokumen_pendukung == 'Approved' ? 'Verifiy' : data.status_dokumen_pendukung == 'Pending' ? 'Pending' : 'Rejected'}</span>
                        </a>
                </div>`);
                $(".download").append(`<a href="../../routes/route.php?page=bebastanggungan&sub=downloadBebasTanggungan&id=${data.bebas_tanggungan_id}" ${data.status_bebas_tanggungan == "Approved" ? '' : 'style="display:none;"'} class="btn btn-download"><i class="fa-solid fa-download"></i><span>Download</span></a>`);
                $("#data_tugas_akhir").append(`
                <li><span>NAMA : </span>${data.nama}</li>
                <li><span>NIM : </span>${data.NIM}</li>
                <li><span>JUDUL : </span>${data.judul}</li>
                `);
            }
        }
    });
}