<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <div class="container-main">
            <form action="../../routes/route.php?page=mahasiswa&sub=addMahasiswa" method="post" enctype="multipart/form-data">
                <select name="user_id" id="dataUser">
                    <option value="" selected disabled>Pilih User Mahasiswa</option>
                </select><br>
                <input type="number" placeholder="NIM" name="nim"><br>
                <input type="text" placeholder="nama" name="nama"><br>
                <input type="text" placeholder="kelas" name="kelas"><br>
                <input type="number" placeholder="telp" name="telp"><br>
                <input type="text" placeholder="temp_lahir" name="temp_lahir"><br>
                <input type="date" placeholder="tgl_lahir" name="tgl_lahir"><br>
                <input type="text" placeholder="alamat" name="alamat"><br>
                <input type="file" name="img"><br>
                <input type="submit" value="Tambah">
            </form>
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
            url: '/Pbl/routes/route.php?page=mahasiswa&sub=getUser',
            success: function(data) {
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(user => {
                        tableContent += `
                        <option value="${user.user_id}">${user.email}</option>
                    `;
                    });
                    $('#dataUser').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>