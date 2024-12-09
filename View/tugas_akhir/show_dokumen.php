<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <a href="javascript: history.go(-1)" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
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
                        <?php
                        if (isset($_SESSION['sukses'])) {
                            echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                        } elseif (isset($_SESSION['error'])) {
                            echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                        }
                        ?>
                    </div>
                    <div class="informasi-dokumen">
                        <div class="pdf">
                        </div>
                        <div class="catatan-dokumen">
                            <div class="card-catatan">
                                <div class="catatan-header">
                                    <span>Catatan Dokumen</span>
                                    <hr>
                                </div>
                                <div class="tambah-catatan">
                                    <?php
                                    if ($_SESSION['user']['role'] == role::MAHSISWA->value) {
                                    } else {
                                    ?>
                                        <a id="button-add-catatan" class="btn btn-tambah-catatan">Tambah</a>
                                        <form action="../../routes/route.php?page=tugasakhir&sub=tambahcatatan&id=<?= $_GET['id'] ?>" method="post" style="display: none;" id="form-catatan">
                                            <input type="text" placeholder="catatan" name="catatan"><br>
                                            <input type="submit" value="Tambah"><br>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        $(document).ready(function() {
            $("#button-add-catatan").click(function() {
                $("#form-catatan").slideToggle("slow");
            });
        });

        function EditCatatan(id) {
            $.ajax({
                type: 'GET',
                url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneCatatan&id=' + id,
                success: function(data) {
                    $(document).ready(function() {
                        $("#form-edit-catatan-" + id).slideToggle("slow");
                    });
                    $('#edit-catatan-' + data.catatan_id).val(data.catatan);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        }

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneDokumen&id=<?= $_GET['id'] ?>',
            success: function(data) {
                $("#data").html(`<p>${data.judul}</p>`);
                $(".pdf").append(`<span>${data.nama_file}</span><br><embed src="../../src/bebas_tanggungan/${data.NIM}/${data.nama_file}" />`)
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getCatatanTA&id=<?= $_GET['id'] ?>',
            success: function(data) {
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(catatan => {
                        tableContent += `
                                <div class="catatan-body">
                                    <div class="text">
                                        ${catatan.catatan}
                                    </div>
                                    <div class="status-catatan">
                                        <div><span>Status Catatan</span></div>
                                            <a style="margin: 10px;" class="status ${catatan.status_catatan_ta == 'Approved' ? 'status-verify' : catatan.status_catatan_ta == 'Pending' ? 'status-revisi' : 'status-submit'}">
                                                        <i class="fa-solid ${catatan.status_catatan_ta == 'Approved' ? 'fa-circle-check' : catatan.status_catatan_ta == 'Pending' ? 'fa-pen-to-square' : 'fa-paper-plane'}"></i>
                                                            <span>${catatan.status_catatan_ta == 'Approved' ? 'Verifiy' : catatan.status_catatan_ta == 'Pending' ? 'Revisi' : 'Pengajuan'}</span>
                                                    </a>
                                    <form method="post" style="display: none;" id="form-edit-catatan-${catatan.catatan_id}">
                                        <input type="text" placeholder="catatan" name="catatan" id="edit-catatan-${catatan.catatan_id}"><br>
                                        <input type="submit" value="Update" onclick="updateCatatan(${catatan.catatan_id})"><br>
                                    </form>
                                        
                                        <div class="verifikasi-catatan">
                                            <div class="catatan-admin">
                                                <a onclick="VerifyCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <span>Verifikasi</span>
                                                </a>
                                                <a onclick="EditCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a onclick="HapusCatatan(${catatan.catatan_id})" class="btn btn-hapus" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:block;"' : ''} ">
                                                    <i class="fa-solid fa-trash"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                            <div class="catatan-mahasiswa">
                                                <a onclick="PengajuanCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_ta == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-paper-plane"></i>
                                                    <span>Pengajuan</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `;
                    });
                    $('.card-catatan').append(tableContent);
                    const role = <?= $_SESSION['user']['role'] ?>;
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

        function VerifyCatatan(id) {
            $.post("/Pbl/routes/route.php?page=tugasakhir&sub=verifikasiCatatan&id=" + id, {
                    id: id
                },
                function(data, status) {
                    alert("Proses verifikasi berhasil!");
                    window.location.reload();
                });
        }

        function updateCatatan(id) {
            $.post("/Pbl/routes/route.php?page=tugasakhir&sub=updateCatatan&id=" + id, {
                    id: id,
                    catatan: $('#edit-catatan-' + id).val()
                },
                function(data, status) {
                    alert("Proses Update berhasil!");
                    window.location.reload();
                });
        }

        function PengajuanCatatan(id) {
            $.post("/Pbl/routes/route.php?page=tugasakhir&sub=pengajuanCatatan&id=" + id, {
                    id: id
                },
                function(data, status) {
                    alert("Proses Pengajuan berhasil!");
                    window.location.reload();
                });
        }

        function HapusCatatan(id) {
            $.post("/Pbl/routes/route.php?page=tugasakhir&sub=hapusCatatan&id=" + id, {
                    id: id
                },
                function(data, status) {
                    alert("Proses Hapus berhasil!");
                    window.location.reload();
                });
        }
    </script>