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
        <a href="tambah.php" rel="modal:open" class="btn btn-tambah">Tambah</a>
        <div class="card-main">
            <div class="header-card">
                <h3>Data Mahasiswa</h3>
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
                        <table class="table display nowrap">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>KELAS</th>
                                    <th>TELEPON</th>
                                    <th>ALAMAT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="dataMahasiswa">

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
    <script src="ajax/index.js"></script>
    <script>
        indexAjax();
    </script>