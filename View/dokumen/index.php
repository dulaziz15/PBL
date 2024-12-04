<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <div class="body-main">
        <?php
        if ($_SESSION['user']['role'] == role::MAHSISWA->value) {
        ?>
            <div class="content-dokumen-mahasiswa">
                <div class="kosong">

                </div>
                <div class="card-main">
                    <div class="header-card">
                        <h3>Informasi Dokumen TA</h3>
                        <hr>
                    </div>
                    <div class="body-card">
                        <div class="container-card">
                            <div class="keterangan">
                                <span>Status Dokumen</span>
                                <p id="status_project"></p>
                            </div>
                            <div class="informasi">
                                <span>informasi tugas akhir</span>
                                <ul id="data_tugas_akhir">

                                </ul>
                            </div>
                            <div class="content-pdf">
                                <div class="pdf dokumen_pdf pdf_tanda_terima_pkl"></div>
                                <div class="pdf dokumen_pdf pdf_tanda_terima_ta"></div>
                                <div class="pdf dokumen_pdf pdf_bebas_kompen"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <a href="tambah.php" class="btn btn-tambah">Tambah</a>
            <div class="table-container tugas_akhir">
                <?php
                if (isset($_SESSION['sukses'])) {
                    echo "<h1>" . $_SESSION['sukses'] . "</h1>";
                } elseif (isset($_SESSION['error'])) {
                    echo "<h1>" . $_SESSION['error'] . "</h1>";
                }
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>JUDUL</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="dataDokumen">
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<?php
unset($_SESSION['sukses']);
unset($_SESSION['error']);
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getAll',
        success: function(data) {
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
                            <a href="edit.php?id=${dokumen.dokumen_pendukung_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                            <a href="../../routes/route.php?page=dokumenpendukung&sub=hapus&id=${dokumen.dokumen_pendukung_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                        </td>
                        </tr>
                    `;
                });
                $('#dataDokumen').html(tableContent);
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
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getOneMahasiswa&id=<?= $_SESSION['user']['user_id'] ?>',
        success: function(data) {
            if (data == false) {
                $(".kosong").html(`<?php include_once "form_dokumen_mahasiswa.php"; ?>`);
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
            }
        }
    });

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getTAMahasiswa&id=' + <?= $_SESSION['user']['user_id'] ?>,
        success: function(data) {
            $("#dataTugasAkhir").val(data.tugas_akhir_id + ":" + data.NIM);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>