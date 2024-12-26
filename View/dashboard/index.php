<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Dashboard</h2>
    </div>
    <div class="body-main">
        <?php if($_SESSION['user']['role'] == role::MAHSISWA->value) {
                include_once 'admin.php';
            } else {
                include_once 'admin.php';
            }
        ?>
    </div>
</div>
<?php
include "../component/footer.php";
?>