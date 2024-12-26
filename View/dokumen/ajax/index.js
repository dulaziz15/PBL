function indexAjax(id, role) {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getAll',
        success: function(data) {
            if(data == false) {
                $(".table-dokumen-pendukung").html(`<h2>Data Dokumen Pendukung Kosong</h2>`)
            } else{
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(dokumen => {
                    tableContent += `
                    <tr>
                    <td>${dokumen.NIM}</td>
                    <td>${dokumen.nama}</td>
                    <td>${dokumen.judul}</td>
                    <td><div>
                <a class="status ${dokumen.status_dokumen_pendukung == 'Approved' ? 'status-verify' : (dokumen.status_dokumen_pendukung == 'Pending' ? 'status-revisi' : 'status-rejected')}">
                    <i class="fa-solid ${dokumen.status_dokumen_pendukung == 'Approved' ? 'fa-circle-check' : dokumen.status_dokumen_pendukung == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${dokumen.status_dokumen_pendukung == 'Approved' ? 'Verifiy' : dokumen.status_dokumen_pendukung == 'Pending' ? 'Revisi' : 'Rejected'}</span>
                        </a>
                </div></td>
                    <td>
                        <a href="../../routes/route.php?page=dokumenpendukung&sub=verifikasiDokumen&id=${dokumen.dokumen_pendukung_id}" onclick=" return confirm('Pastikan semua catatan sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                        <a href="show.php?id=${dokumen.dokumen_pendukung_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                        <a href="edit.php?id=${dokumen.dokumen_pendukung_id}" rel="modal:open" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                        <a href="../../routes/route.php?page=dokumenpendukung&sub=hapus&id=${dokumen.dokumen_pendukung_id}" onclick="return confirm('Apakah anda yakin ingin menghapus data Dokumen dengan judul ${dokumen.judul} ?')" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                    </td>
                    </tr>
                `;
                });
                $('#dataDokumen').html(tableContent);
                $('table').DataTable({
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
                // console.error("Expected an array but received:", data);
            }
        }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getOneMahasiswa&id=' + id,
        success: function(data) {
            if (data == false) {
                $(".data-dokumen-mahasiswa").css('display', 'none');
                $(".kosong").css('display', 'block');
            } else {
                $("#status_project").append(`<div>
                <a class="status ${data.status_dokumen_pendukung == 'Approved' ? 'status-verify' : data.status_dokumen_pendukung == 'Pending' ? 'status-revisi' : 'status-rejected'}">
                        <i class="fa-solid ${data.status_dokumen_pendukung == 'Approved' ? 'fa-circle-check' : data.status_dokumen_pendukung == 'Pending' ? 'fa-pen-to-square' : 'fa-circle-xmark'}"></i>
                        <span>${data.status_dokumen_pendukung == 'Approved' ? 'Verifiy' : data.status_dokumen_pendukung == 'Pending' ? 'Revisi' : 'Rejected'}</span>
                        </a>
                </div>`);
                $("#data_tugas_akhir").append(`
                <li><span>NAMA : </span>${data.nama}</li>
                <li><span>NIM : </span>${data.NIM}</li>
                <li><span>JUDUL : </span>${data.judul}</li>
                `);

                $.ajax({
                    type: 'GET',
                    url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getOneByTugasAkhir&id=' + data.tugas_akhir_id,
                    success: function(data) {
                        $(".pdf_tanda_terima_pkl").append(`<span>${data.tanda_terima_pkl}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.tanda_terima_pkl}" />`);
                        $(".pdf_tanda_terima_ta").append(`<span>${data.tanda_terima_ta}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.tanda_terima_ta}" />`);
                        $(".pdf_bebas_kompen").append(`<span>${data.bebas_kompen}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.bebas_kompen}" />`);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getCatatan&id=' + data.dokumen_pendukung_id,
                    success: function(data) {
                        console.log(data);
                        if (Array.isArray(data)) {
                            let tableContent = '';
                            data.forEach(catatan => {
                                tableContent += `
                            <div class="catatan-content-body">
                                        <div class="catatan-body">
                                        <div class="text">
                                            ${catatan.catatan}
                                        </div>
                                        <div class="status-catatan">
                                            <div><span>Status Catatan</span></div>
                                                <a style="margin: 10px;" class="status ${catatan.status_catatan_pendukung == 'Approved' ? 'status-verify' : catatan.status_catatan_pendukung == 'Pending' ? 'status-revisi' : 'status-submit'}">
                                                    <i class="fa-solid ${catatan.status_catatan_pendukung == 'Approved' ? 'fa-circle-check' : catatan.status_catatan_pendukung == 'Pending' ? 'fa-pen-to-square' : 'fa-paper-plane'}"></i>
                                                        <span>${catatan.status_catatan_pendukung == 'Approved' ? 'Verifiy' : catatan.status_catatan_pendukung == 'Pending' ? 'Revisi' : 'Pengajuan'}</span>
                                                </a>
                                            <form method="post" style="display: none;" id="form-edit-catatan-${catatan.catatan_id}">
                                                <input type="text" placeholder="catatan" name="catatan" id="edit-catatan-${catatan.catatan_id}"><br>
                                                <input type="submit" value="Update" onclick="updateCatatan(${catatan.catatan_id})"><br>
                                            </form>
                                            <div class="verifikasi-catatan">
                                                <div class="catatan-admin">
                                                    <a onclick="VerifyCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        <span>Verifikasi</span>
                                                    </a>
                                                    <a onclick="EditCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a onclick="HapusCatatan(${catatan.catatan_id})" class="btn btn-hapus" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:block;"' : ''} ">
                                                        <i class="fa-solid fa-trash"></i>
                                                        <span>Hapus</span>
                                                    </a>
                                                </div>
                                                <div class="catatan-mahasiswa">
                                                    <a onclick="PengajuanCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                        <span>Pengajuan</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });
                            $('.catatan-content').append(tableContent);
                            if (role == 2) {
                                $('.catatan-admin').css('display', 'none');
                            } else {
                                $('.catatan-mahasiswa').css('display', 'none');
                            }
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
}

function PengajuanCatatan(id) {
    $.post("/Pbl/routes/route.php?page=dokumenpendukung&sub=pengajuanCatatan&id=" + id, {
            id: id
        },
        function(data, status) {
            alert("Proses Pengajuan berhasil!");
            window.location.reload();
        });
}