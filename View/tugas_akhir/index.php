<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <a href="tambah.php" class="btn btn-tambah">Tambah</a>
        <?php
        if (isset($_SESSION['sukses'])) {
            echo "<h1>" . $_SESSION['sukses'] . "</h1>";
        } elseif (isset($_SESSION['error'])) {
            echo "<h1>" . $_SESSION['error'] . "</h1>";
        }
        ?>
        <div class="table-container tugas_akhir">
            <table class="table">
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
    <?php
    include "../component/footer.php";
    ?>
    <?php
    unset($_SESSION['sukses']);
    unset($_SESSION['error']);
    ?>
    <script src="ajax/ajax.js"></script>
    <script>
        getAll();
    </script>