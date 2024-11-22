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
                            <div class="catatan-header">
                                <span>Catatan Dokumen</span>
                                <hr>
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
        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOneDokumen&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                $("#data").html(`<p>${data.judul}</p>`);
                $(".pdf").append(`<span>${data.nama_file}</span><br><embed src="../../src/bebas_tanggungan/${data.mahasiswa_id}/${data.nama_file}" width="500px" height="500px" />`)
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>