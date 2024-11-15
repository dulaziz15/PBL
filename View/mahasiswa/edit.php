<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <h1>Edit Data Mahasiswa</h1>
        <form action="../../routes/route.php?page=mahasiswa&sub=updateMahasiswa&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
            <select name="user_id" id="dataUser">
                
            </select><br>
            <input type="number" placeholder="NIM" name="nim" id="nim"><br>
            <input type="text" placeholder="nama" name="nama" id="nama"><br>
            <input type="text" placeholder="kelas" name="kelas" id="kelas"><br>
            <input type="number" placeholder="telp" name="telp" id="telp"><br>
            <input type="text" placeholder="temp_lahir" name="temp_lahir" id="temp_lahir"><br>
            <input type="date" placeholder="tgl_lahir" name="tgl_lahir" id="tgl_lahir"><br>
            <input type="text" placeholder="alamat" name="alamat" id="alamat"><br>
            <input type="file" name="img" id="img"><br>
            <input type="submit" value="Tambah">
        </form>
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
            url: '/Pbl/routes/route.php?page=mahasiswa&sub=getWithUser&id=' + <?= $_GET['id'] ?>,
            success: function(data) {
                // console.log(data);
                $("#nim").val(data.NIM);
                $("#nama").val(data.nama);
                $("#kelas").val(data.kelas);
                $("#telp").val(data.telp);
                $("#temp_lahir").val(data.temp_lahir);
                $("#tgl_lahir").val(data.tgl_lahir);
                $("#alamat").val(data.alamat);
                $("#dataUser").append(`<option value="${data.user_id}" selected>${data.email}</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/Pbl/routes/route.php?page=mahasiswa&sub=getUser',
                    success: function(data) {
                        if (Array.isArray(data)) {
                        let tableContent = '';
                        data.forEach(user => {
                            tableContent += `
                            <option value="${user.user_id}">${user.email}
                        `;
                        });
                    $('#dataUser').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
                    }
                })
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>