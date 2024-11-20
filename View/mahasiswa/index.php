<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Mahasiswa</h2>
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
        <div class="table-container">
            <table class="table">
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
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(mahasiswa => {
                        tableContent += `
                        <tr>
                        <td>${mahasiswa.NIM}</td>
                        <td>${mahasiswa.nama}</td>
                        <td>${mahasiswa.kelas}</td>
                        <td>${mahasiswa.telp}</td>
                        <td>${mahasiswa.alamat}</td>
                        <td>
                            <a href="show.php?id=${mahasiswa.mahasiswa_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                            <a href="../../routes/route.php?page=mahasiswa&sub=edit&id=${mahasiswa.mahasiswa_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                            <a href="../../routes/route.php?page=mahasiswa&sub=hapus&id=${mahasiswa.mahasiswa_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                        </td>
                        </tr>
                    `;
                    });
                    $('#dataMahasiswa').html(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>