<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Bebas Tanggungan</h2>
    </div>
    <div class="body-main">
        <a href="tambah.php" class="btn btn-tambah">Tambah</a>
        <div class="table-container tugas_akhir">
            <?php
            if (isset($_SESSION['sukses'])) {
                echo "<h1>" . $_SESSION['sukses'] . "</h1>";
            } elseif (isset($_SESSION['error'])) {
                echo "<h1>" . $_SESSION['error'] . "</h1>";
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>NAMA</th>
                        <th>NO SURAT</th>
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
        url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getAll',
        success: function(data) {
            console.log(data);
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(dokumen => {
                    tableContent += `
                        <tr>
                        <td>${dokumen.NIM}</td>
                        <td>${dokumen.nama}</td>
                        <td>${dokumen.no_surat}</td>
                        <td><div>
                    <a class="status ${dokumen.status_bebas_tanggungan == 'Approved' ? 'status-verify' : 'status-revisi'}">
                        <i class="fa-solid ${dokumen.status_bebas_tanggungan == 'Approved' ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                            <span>${dokumen.status_bebas_tanggungan == 'Approved' ? 'Available' : 'Pending'}</span>
                            </a>
                    </div></td>
                        <td>
                            <a href="../../routes/route.php?page=bebastanggungan&sub=verifikasi&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan != "Approved" ? '' : 'style="display:none;"'} onclick=" return confirm('Pastikan semua catatan sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                            <a href="../../routes/route.php?page=bebastanggungan&sub=verifikasiDokumen&id=${dokumen.bebas_tanggungan_id}" ${dokumen.status_bebas_tanggungan == "Approved" ? '' : 'style="display:none;"'} onclick=" return confirm('Pastikan semua dokumen telah terverifikasi !')" class="btn btn-download"><i class="fa-solid fa-download"></i><span>Download</span></a>
                            <a href="edit.php?id=${dokumen.bebas_tanggungan_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                            <a href="../../routes/route.php?page=bebastanggungan&sub=hapus&id=${dokumen.bebas_tanggungan_id}" class="btn btn-hapus"><i class="fa-solid fa-trash"></i><span>Hapus</span></a>
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