<?php

use Pbl\Enums\role;

include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <div class="body-main">
        <?php
        if ($_SESSION['user']['role'] == role::MAHSISWA->value) {
        ?>
            <div class="content-dokumen-mahasiswa">
                <div class="kosong" style="display: none;">
                    <?php include_once 'tambah_mahasiswa.php' ?>
                </div>
                <div class="card-main data-dokumen-mahasiswa">
                    <div class="header-card">
                        <h3>Informasi Dokumen Pendukung</h3>
                        <hr>
                    </div>
                    <div class="body-card">
                        <div class="container-card">
                            <div class="keterangan">
                                <span>Status Dokumen</span>
                                <p id="status_project"></p>
                            </div>
                            <div class="informasi">
                                <span>informasi tugas akhir</span>
                                <ul id="data_tugas_akhir">

                                </ul>
                            </div>
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
                                    <div class="catatan-content">

                                    </div>
                                </div>
                            </div>
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
                    <h3>Data Dokumen Pendukung</h3>
                    <hr>
                </div>
                <div class="body-card">
                    <div class="container-card">
                        <div class="table-container">
                            <?php
                            if (isset($_SESSION['sukses'])) {
                                echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                            } elseif (isset($_SESSION['error'])) {
                                echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                            }
                            ?>
                            <table class="table display nowrap table-dokumen-pendukung">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>NAMA</th>
                                        <th>JUDUL</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="dataDokumen">
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
    <script src="ajax/index.js"></script>
    <script>
        indexAjax(<?= $_SESSION['user']['user_id'] ?>, <?= $_SESSION['user']['role'] ?>)
    </script>