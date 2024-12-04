<?php

use Pbl\Enums\role;

include_once "../component/header.php";
include_once "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <?php
        if (isset($_SESSION['sukses'])) {
            echo "<h1>" . $_SESSION['sukses'] . "</h1>";
        } elseif (isset($_SESSION['error'])) {
            echo "<h1>" . $_SESSION['error'] . "</h1>";
        }

        if ($_SESSION['user']['role'] == role::MAHSISWA->value) { ?>
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
                            <span>Status Project</span>
                            <p id="status_project"></p>
                        </div>
                        <div class="informasi">
                            <span>informasi tugas akhir</span>
                            <ul id="data_tugas_akhir">

                            </ul>
                        </div>
                        <div class="table-container dokumen">
                            <table class="table list-dokumen-ta-mahasiswa">
                                <?php
                                if (isset($_SESSION['sukses'])) {
                                    echo "<h1>" . $_SESSION['sukses'] . "</h1>";
                                } elseif (isset($_SESSION['error'])) {
                                    echo "<h1>" . $_SESSION['error'] . "</h1>";
                                }
                                ?>
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NIM</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTugasAkhirMahasiswa">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
        
        <a href="tambah.php" class="btn btn-tambah">Tambah</a>
            <div class="table-container tugas_akhir">
                <table class="table table-list">
                    <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>NIM</th>
                            <th>JUDUL</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="dataTugasAkhir">
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
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
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneMahasiswa&id=<?= $_SESSION['user']['user_id'] ?>',
            success: function(data) {
                console.log(data);
                if (data == false) {
                    $(".kosong").html(`<?php  include_once "form_ta_mahasiswa.php"; ?>`);
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
                                $('.list-dokumen-ta-mahasiswa').DataTable();
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
                    <a href="../../routes/route.php?page=tugasakhir&sub=edit&id=${tugas_akhir.tugas_akhir_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                    <a href="../../routes/route.php?page=tugasakhir&sub=hapus&id=${tugas_akhir.tugas_akhir_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                </td>
                </tr>
            `;
                    });
                    $('#dataTugasAkhir').html(tableContent);
                    $('.table-list').DataTable({
                        paging: true, // Menampilkan paginasi
                        searching: true, // Mengaktifkan pencarian
                        ordering: true, // Mengaktifkan sorting
                        info: true, // Menampilkan informasi tabel
                        autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                        responsive: true, // Menyusun ulang kolom secara responsif di perangkat mobile
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
            url: '/Pbl/routes/route.php?page=mahasiswa&sub=getByUser&id=<?= $_SESSION['user']['user_id'] ?>',
            success: function(data) {
                $("#mahasiswa_tambah_ta").val(data.mahasiswa_id + ":" + data.NIM);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>