<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <div class="body-main">
        <div class="table-container tugas_akhir">
            <?php
            if (isset($_SESSION['sukses'])) {
                echo "<h1>" . $_SESSION['sukses'] . "</h1>";
            } elseif (isset($_SESSION['error'])) {
                echo "<h1>" . $_SESSION['error'] . "</h1>";
            }
            ?>
            <form action="../../routes/route.php?page=dokumenpendukung&sub=updateDokumen&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                <select name="bagian" id="dataTugasAkhir">
                    <option value="tanda_terima_pkl">Tanda Terima PKL</option>
                    <option value="tanda_terima_ta">Tanda Terima TA</option>
                    <option value="bebas_kompen">Bebas Kompen</option>
                </select>
                <label for="tanda_terima_ta">Upload Dokumen</label><br>
                    <input type="file" name="dokumen" id="" accept="application/pdf"><br>
                <input type="submit" value="Tambah">
            </form>
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