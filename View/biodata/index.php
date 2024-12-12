<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
        <div id="buttonBiodata">

        </div>
        <div class="card-main">
            <div class="header-card">
                <h3>Informasi Dokumen Pendukung</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <div class="biodata-mahasiswa">
                        <div class="foto-profil">
                            <div class="img-profile">
                                
                            </div>
                            <div class="keterangan-profil">
                                
                            </div>
                            <div class="kontak">

                            </div>
                        </div>
                        <div class="data-profil">
                            <div class="data-biodata">
                                <h1>Informasi Mahasiswa</h1>
                                <table border="0" id="table-biodata">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>Abdul Aziz</td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td>2221771013</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td>2G</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telp</td>
                                        <td>:</td>
                                        <td>0836273</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>Cirebon, 15 Juli 2004</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Cirebon</td>
                                    </tr>
                                </table>
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
    <script>
        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=biodata&sub=getOne&id= ' + <?= $_SESSION['user']['user_id'] ?>,
            success: function(data) {
                console.log(data);
                if (data == false) {
                    $("#buttonBiodata").append(`<a href="" id="btn-create-biodata">Biodata Anda belum lengkap, Lengkapi Biodata</a>`);
                } else {
                    $(".keterangan-profil").append(`
                    <h4>${data.nama}</h4>
                    <h4>${data.NIM}</h4>
                    `)
                    $(".img-profile").append(`<img src="../../src/img/mahasiswa/${data.img}" alt="">`)
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>