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
                    $('table').DataTable({
                        paging: true, // Menampilkan paginasi
                        searching: true, // Mengaktifkan pencarian
                        ordering: true, // Mengaktifkan sorting
                        info: true, // Menampilkan informasi tabel
                        autoWidth: true, // Menonaktifkan pengaturan otomatis lebar kolom
                        responsive: true,
                        rowReorder: {
                            selector: 'td:nth-child(2)'
                        }
                    });
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    </script>