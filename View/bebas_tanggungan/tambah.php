<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Bebas Tanggungan</h2>
    </div>
    <div class="body-main">
        <div class="card-main">
            <div class="header-card">
                <h3>Tambah Bebas Tanggungan</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=bebastanggungan&sub=add" method="post">
                        <select name="tugas_akhir" id="list-tugas-akhir" required>

                        </select>
                        <input type="submit" value="Tambah">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<script src="ajax/tambah.js"></script>