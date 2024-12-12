<?php

use Pbl\Enums\role;

include_once "../component/header.php";
include_once "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <?php

        if ($_SESSION['user']['role'] == role::MAHSISWA->value) { ?>
            <div class="kosong">
                <?php include 'form_ta_mahasiswa.php' ?>
            </div>
            <div class="card-main">
                <div class="header-card">
                    <h3>Informasi Dokumen TA</h3>
                    <hr>
                    <?php
                    if (isset($_SESSION['sukses'])) {
                        echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                    } elseif (isset($_SESSION['error'])) {
                        echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                    }
                    ?>
                </div>
                <div class="body-card">
                    <div class="container-card">
                        <div class="keterangan">
                            <span>Status Project</span>
                            <p id="status_project"></p>
                        </div>
                        <div class="informasi">
                            <span>informasi tugas akhir</span>
                            <ul id="data_tugas_akhir">

                            </ul>
                        </div>
                        <div class="table-container dokumen">
                            <table class="table list-dokumen-ta-mahasiswa display nowrap">
                                <?php
                                if (isset($_SESSION['sukses'])) {
                                    echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                                } elseif (isset($_SESSION['error'])) {
                                    echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                                }
                                ?>
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NIM</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTugasAkhirMahasiswa">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>

            <a href="tambah.php" rel="modal:open" class="btn btn-tambah">Tambah</a>
            <div class="card-main">
                <div class="header-card">
                    <h3>Data Dokumen Tugas Akhir</h3>
                    <hr>
                    <?php
                    if (isset($_SESSION['sukses'])) {
                        echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                    } elseif (isset($_SESSION['error'])) {
                        echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                    }
                    ?>
                </div>
                <div class="body-card">
                    <div class="container-card">
                        <div class="table-container">
                            <table class="table list-ta display nowrap">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>NIM</th>
                                        <th>JUDUL</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTugasAkhir">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    include "../component/footer.php";
    ?>
    <?php
    unset($_SESSION['sukses']);
    unset($_SESSION['error']);
    ?>
    <script src="./ajax/index.js"></script>
    <script>
        indexAjax(<?= $_SESSION['user']['user_id'] ?>)
    </script>