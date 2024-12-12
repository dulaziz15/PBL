<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
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
                                <div class="form-catatan tambah-catatan">
                                    <?php
                                    if ($_SESSION['user']['role'] == role::MAHSISWA->value) {
                                    } else {
                                    ?>
                                        <a id="button-add-catatan" class="btn btn-tambah-catatan">Tambah</a>
                                        <form action="../../routes/route.php?page=tugasakhir&sub=tambahcatatan&id=<?= $_GET['id'] ?>" method="post" style="display: none;" class="form-catatan" id="form-catatan">
                                            <input type="text" placeholder="catatan" name="catatan"><br>
                                            <input type="submit" class="btn" value="Tambah"><br>
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
    <script src="./ajax/showDokumen.js"></script>
    <script>
        showAjax(<?= $_GET['id'] ?>, <?= $_SESSION['user']['role'] ?>)
    </script>