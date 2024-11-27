<?php
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
                                    <a id="button-add-catatan" class="btn btn-tambah-catatan">Tambah</a>
                                    <form action="../../routes/route.php?page=tugasakhir&sub=tambahcatatan&id=<?= $_GET['id'] ?>" method="post" style="display: none;" id="form-catatan">
                                        <input type="text" placeholder="catatan" name="catatan"><br>
                                        <input type="submit" value="Tambah"><br>
                                    </form>
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

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneDokumen&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                $("#data").html(`<p>${data.judul}</p>`);
                $(".pdf").append(`<span>${data.nama_file}</span><br><embed src="../../src/bebas_tanggungan/${data.mahasiswa_id}/${data.nama_file}" />`)
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getCatatanTA&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
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
                                            <a style="margin-right: 10px;" class="status ${catatan.status == 1 ? 'status-verify' : 'status-revisi'}">
                                                        <i class="fa-solid ${catatan.status == 1 ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                                                            <span>${catatan.status == 1 ? 'Verifiy' : 'Revisi'}</span>
                                                    </a>
                                        <div class="verifikasi-catatan">
                                        <a onclick="UpdateCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status == 1 ? 'style="display:none;"' : ''} ">
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span>Verifikasi</span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                        `;
                    });
                    $('.card-catatan').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        function UpdateCatatan(id) {
            $.post("/Pbl/routes/route.php?page=tugasakhir&sub=verifikasiCatatan&id=" + id, {
                    id: id,
                    status: 1
                },
                function(data, status) {
                    window.location.reload();
                });
        }
    </script>