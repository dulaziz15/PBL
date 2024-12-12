<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Bebas Tanggungan</h2>
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
                        <?php
                        if (isset($_SESSION['sukses'])) {
                            echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                        } elseif (isset($_SESSION['error'])) {
                            echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                        }
                        ?>
                    </div>
                    <div class="body-card">
                        <div class="container-card">
                            <div class="informasi">
                                <span>informasi tugas akhir</span>
                                <ul id="data_tugas_akhir">

                                </ul>
                            </div>
                            <div class="keterangan">
                                <span>Status Bebas Tanggungan</span>
                                <p id="status_project"></p>
                            </div>
                            <div class="keterangan">
                                <span>Status Tugas Akhir</span>
                                <p id="status_ta"></p>
                            </div>
                            <div class="keterangan">
                                <span>Status Dokumen Pendukung</span>
                                <p id="status_dokumen"></p>
                            </div>
                            <div class="download">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <a href="tambah.php" class="btn btn-tambah">Tambah</a>
            <div class="card-main">
                <div class="header-card">
                    <h3>Data Bebas Tanggungan</h3>
                    <hr>
                </div>
                <div class="body-card">
                    <div class="container-card">

                        <div class="table-container">
                            <?php
                            if (isset($_SESSION['sukses'])) {
                                echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                            } elseif (isset($_SESSION['error'])) {
                                echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                            }
                            ?>
                            <table class="table display nowrap table-bebas-tanggungan">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>NAMA</th>
                                        <th>NO SURAT</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDokumen">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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
            url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getAll',
            success: function(data) {
                console.log(data);
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
                            <a href="../../routes/route.php?page=bebastanggungan&sub=verifikasi&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan != "Approved" ? '' : 'style="display:none;"'} onclick=" return confirm('Pastikan semua catatan sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                            <a href="../../routes/route.php?page=bebastanggungan&sub=downloadBebasTanggungan&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan == "Approved" ? '' : 'style="display:none;"'} class="btn btn-download"><i class="fa-solid fa-download"></i><span>Download</span></a>
                            <a href="../../routes/route.php?page=bebastanggungan&sub=hapus&id=${dokumen.bebas_tanggungan_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
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
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getOneMahasiswa&id=<?= $_SESSION['user']['user_id'] ?>',
            success: function(data) {
                if (data == false) {
                    $(".kosong").html(`<h1>Request</h1>`);
                    $(".card-main").css('display', 'none');
                } else {
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
    </script>