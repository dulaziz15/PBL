<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management biodata</h2>
    </div>
    <div class="body-main">
        <div id="buttonBiodata">

        </div>
        <div class="card-main">
            <div class="header-card">
                <h3>Biodata Mahasiswa</h3>
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
                                <h3>Biodata Mahasiswa</h3>
                                <ul id="data-biodata">

                                </ul>
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
                    <h3>${data.nama}</h3>
                    <h3>${data.NIM}</h3>
                    `)
                    $(".img-profile").append(`<img src="../../src/img/mahasiswa/${data.img}" alt="">`)
                    $("#data-biodata").append(`
                        <li>Nama: ${data.nama}</li>
                        <li>NIM: ${data.NIM}</li>
                        <li>kelas: ${data.kelas}</li>
                        <li>No Telp: ${data.telp}</li>
                        <li>Tempat, Tanggal lahir: ${data.temp_lahir + ', ' + data.tgl_lahir}</li>
                        <li>Alamat: ${data.alamat}</li>
                    `);
                    $(".data-profil").append(`<a href="edit.php?id=${data.mahasiswa_id}" rel="modal:open" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>`)
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>