<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Mahasiswa</h2>
    </div>
    <div class="body-main">
        <div id="data">

        </div>
    </div>
    <?php
    include "../component/footer.php";
    ?>
    <script src="ajax/show.js"></script>
    <script>
        showAjax(<?= $_GET['id'] ?>);
    </script>