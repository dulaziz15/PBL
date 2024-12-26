<?php
    session_start();
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
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
                <form action="../../routes/route.php?page=tugasakhir&sub=updateDokumenTA&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <label for="fileproject">Dokumen</label><br>
                    <input type="file" name="dokumen" id="fileproject" accept="application/pdf" required><br>
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>
    </div>

    <!-- <div class="body-main" id="modal-tambah-mahasiswa">
        <div class="card-main">
            <div class="header-card">
                <h3>Edit Dokumen Tugas Akhir</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=tugasakhir&sub=update&id=<?= $_GET['id'] ?>" enctype="multipart/form-data" method="POST">
                        <div class="form-modal">
                            <div class="form-input">
                                <label for="">Judul</label>
                                <input type="text" name="judul" id="judul" required>
                            </div>
                            <div class="form-input">
                                <label for="">File Project</label>
                                <input type="file" name="fileproject" id="fileproject" required>
                            </div>
                            <div class="form-input-submit">
                                <input class="btn btn-submit" type="submit" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
    <script src="ajax/edit.js"></script>
    <script>
        editAjax(<?= $_GET['id'] ?>)
    </script>