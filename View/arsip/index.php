<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Arsip Dokumen</h2>
    </div>
    <div class="body-main">
        <div class="card-main">
            <div class="header-card">
                <h3>Arsip Dokumen</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <div class="table-container">
                        <table class="table display nowrap data-arsip">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="dataArsip">
                        
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