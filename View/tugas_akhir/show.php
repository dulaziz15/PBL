<?php
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
                    </div>
                    <div class="informasi">
                        <span>informasi tugas akhir</span>
                        <ul id="data_tugas_akhir">

                        </ul>
                    </div>
                    <div class="table-container dokumen">
                        <table class="table">
                            <?php
                            if (isset($_SESSION['sukses'])) {
                                echo "<h3 class='alert-sukses'><i class='fa-solid fa-circle-check'></i>" . $_SESSION['sukses'] . "</h3>";
                            } elseif (isset($_SESSION['error'])) {
                                echo "<h3  class='alert-error'><i class='fa-solid fa-warning'></i>" . $_SESSION['error'] . "</h3>";
                            }
                            ?>
                            <thead>
                                <tr>
                                    <th>BAGIAN</th>
                                    <th>NAMA FILE</th>
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
        showAjax(<?= $_GET['id'] ?>)
    </script>
