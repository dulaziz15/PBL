<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <?php
        if (isset($_SESSION['sukses'])) {
            echo "<h1>" . $_SESSION['sukses'] . "</h1>";
        } elseif (isset($_SESSION['error'])) {
            echo "<h1>" . $_SESSION['error'] . "</h1>";
        }
        ?>
    <div class="body-main">
        <a href="tambah.php" class="btn btn-tambah">Tambah</a>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>NAMA</th>
                        <th>JUDUL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="dataDokumen">
                </tbody>
            </table>
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
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getAll',
        success: function(data) {
            console.log(data);
            if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(dokumen => {
                        tableContent += `
                        <tr>
                        <td>${dokumen.NIM}</td>
                        <td>${dokumen.nama}</td>
                        <td>${dokumen.judul}</td>
                        <td>${dokumen.status}</td>
                        <td>
                            <a href="show.php?id=${dokumen.dokumen_pendukung_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                            <a href="../../routes/route.php?page=dokumenpendukung&sub=edit&id=${dokumen.dokumen_pendukung_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                            <a href="../../routes/route.php?page=dokumenpendukung&sub=hapus&id=${dokumen.dokumen_pendukung_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
                        </td>
                        </tr>
                    `;
                    });
                    $('#dataDokumen').html(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>