<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <div class="body-main">
        <a href="javascript: history.go(-1)" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        <div class="content-pdf">
            <div class="pdf dokumen_pdf pdf_tanda_terima_pkl"></div>
            <div class="pdf dokumen_pdf pdf_tanda_terima_ta"></div>
            <div class="pdf dokumen_pdf pdf_bebas_kompen"></div>
        </div>
        <div class="catatan-dokumen pendukung">
            <div class="card-catatan">
                <div class="catatan-header">
                    <span>Catatan Dokumen</span>
                    <hr>
                </div>
                <div class="tambah-catatan">
                    <a id="button-add-catatan" class="btn btn-tambah-catatan">Tambah</a>
                    <form action="../../routes/route.php?page=dokumenpendukung&sub=tambahcatatan&id=<?= $_GET['id'] ?>" method="post" style="display: none;" id="form-catatan">
                        <input type="text" placeholder="catatan" name="catatan" required><br>
                        <input type="submit" value="Tambah"><br>
                    </form>
                </div>
                <div class="catatan-content">

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
<script src="ajax/show.js"></script>
<script>
    showAjax(<?= $_GET['id'] ?>, <?= $_SESSION['user']['role'] ?>)
</script>