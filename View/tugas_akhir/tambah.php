<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <a href="" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        <div class="card-main">
            <div class="header-card">
                <h3>Informasi Dokumen TA</h3>
                <hr>
            </div>
            <div class="body-card">
                <form action="../../routes/route.php?page=tugasakhir&sub=add" method="post" enctype="multipart/form-data">
                    <label for="judul">JUDUL</label><br>
                    <input type="text" name="judul" id="judul"><br>
                    <label for="fileproject">File Project</label><br>
                    <input type="file" name="fileproject" id="fileproject"><br>
                    <label for="pendahuluan">Pendahuluan</label><br>
                    <input type="file" name="pendahuluan" id="pendahuluan" accept="application/pdf"><br>
                    <label for="abstrak">Abstrak</label><br>
                    <input type="file" name="abstrak" id="abstrak" accept="application/pdf"><br>
                    <label for="bab1">ISI LAPORAN</label><br>
                    <input type="file" name="isi" id="bab1" accept="application/pdf"><br>
                    <label for="daftarpusataka">Daftar Pustaka</label><br>
                    <input type="file" name="daftarpustaka" id="daftarpustaka" id="daftarpustaka" accept="application/pdf"><br>
                    <label for="lampiran">Lampiran</label><br>
                    <input type="file" name="lampiran" id="lampiran" accept="application/pdf"><br>
                    <!-- <select name="mahasiswa" id="dataMahasiswa" style="width: 300px;" class="operator">

                    </select><br> -->
                    <input type="submit" value="Tambah">
                </form>
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
            url: '/Pbl/routes/route.php?page=mahasiswa&sub=getAll',
            success: function(data) {
                // console.log(data);
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(mahasiswa => {
                        tableContent += `
                        <option value="${mahasiswa.mahasiswa_id}">${mahasiswa.nama}</option>
                    `;
                    });
                    $('#dataMahasiswa').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
        $(document).ready(function() {
            $("select").select2();
        });
    </script>