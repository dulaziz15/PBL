<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
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
                                <img src="../../src/img/logo_poltek.png" alt="">
                            </div>
                            <div class="keterangan-profil">
                                <h4>ABDUL AZIZ</h4>
                                <h4>2221771013</h4>
                                <h4>D-4 Teknik Informatika</h4>
                                <h4>2G</h4>
                            </div>
                            <div class="kontak">

                            </div>
                        </div>
                        <div class="data-profil">
                            <div class="data-biodata">
                                <h1>Informasi Keluarga</h1>
                                <ul>
                                    <li>Tempat Lahir</li>
                                </ul>
                                <h1>Informasi Keluarga</h1>
                                <ul>
                                    <li>Tempat Lahir</li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="informasi-mahasiswa">Informasi Mahasiswa</div>
                        <div class="tempat-lahir-tanggal-lahir-umur-alamat-jenis-kelamin-agama">
                            <span>
                                <ul
                                    class="tempat-lahir-tanggal-lahir-umur-alamat-jenis-kelamin-agama-span">
                                    <li>Tempat Lahir</li>
                                    <br />
                                    <li>Tanggal Lahir</li>
                                    <br />
                                    <li>Umur</li>
                                    <br />
                                    <li>Alamat</li>
                                    <br />
                                    <li>Jenis Kelamin</li>
                                    <br />
                                    <li>Agama</li>
                                    <br />

                                </ul>
                            </span>
                        </div>
                        <div
                            class="cirebon-bandung-14-juli-2004-20-tahun-jl-tlogomas-laki-laki-atheis">
                            Cirebon, Bandung
                            <br />
                            <br />
                            14 Juli 2004
                            <br />
                            <br />
                            20 Tahun
                            <br />
                            <br />
                            JL. Tlogomas
                            <br />
                            <br />
                            Laki - Laki
                            <br />
                            <br />
                            Atheis
                        </div>
                        <div class="informasi-keluarga">Informasi Keluarga</div>
                        <div class="nama-ayah-nama-ibu-nik-ayah-nik-ibu">
                            <span>
                                <ul class="nama-ayah-nama-ibu-nik-ayah-nik-ibu-span">
                                    <li>Nama Ayah</li>
                                    <br />
                                    <li>Nama Ibu</li>
                                    <br />
                                    <li>NIK Ayah</li>
                                    <br />
                                    <li>NIK Ibu</li>
                                    <br />

                                </ul>
                            </span>
                        </div>
                        <div class="agus-siti-0129301238127372-1230812308212222">
                            Agus
                            <br />
                            <br />
                            Siti
                            <br />
                            <br />
                            0129301238127372
                            <br />
                            <br />
                            1230812308212222
                            <br />
                        </div>
                        <div class="informasi-domisili">Informasi Domisili</div>
                        <div class="alamat-rt-rw-kelurahan-kecamatan-kota-kode-pos">
                            <span>
                                <ul class="alamat-rt-rw-kelurahan-kecamatan-kota-kode-pos-span">
                                    <li>Alamat</li>
                                    <br />
                                    <li>RT/RW</li>
                                    <br />
                                    <li>Kelurahan</li>
                                    <br />
                                    <li>Kecamatan</li>
                                    <br />
                                    <li>Kota</li>
                                    <br />
                                    <li>Kode Pos</li>
                                    <br />

                                </ul>
                            </span>
                        </div>
                        <div class="jl-tlogomas-04-06-merjosari-lowokwaru-malang-65144">
                            JL. Tlogomas
                            <br />
                            <br />
                            04/06
                            <br />
                            <br />
                            Merjosari
                            <br />
                            <br />
                            Lowokwaru
                            <br />
                            <br />
                            Malang
                            <br />
                            <br />
                            65144
                        </div>
                        <div class="rectangle-59"></div>
                        <img class="rectangle-48" src="profil.png" />
                        <div class="abdul-aziz-2221771013-d-4-teknik-informatika-2-g-02">
                            Abdul Aziz
                            <br />
                            <br />
                            2221771013
                            <br />
                            <br />
                            D-4 Teknik Informatika
                            <br />
                            <br />
                            2G / 02
                            <br />
                            <br />
                        </div> -->
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
            url: '/Pbl/routes/route.php?page=biodata&sub=getone&id= ' + <?= $_SESSION['user']['user_id'] ?>,
            success: function(data) {
                if (data == false) {
                    $("#buttonBiodata").append(`<a href="" id="btn-create-biodata">Biodata Anda belum lengkap, Lengkapi Biodata</a>`);
                } else {
                    $("#biodata").append(`<h2>${data.nama}</h2>`);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>