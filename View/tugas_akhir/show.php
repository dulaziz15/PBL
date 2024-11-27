<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Tugas Akhir</h2>
    </div>
    <div class="body-main">
        <a href="javascript: history.go(-1)" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        <div class="card-main">
            <div class="header-card">
                <h3>Informasi Dokumen TA</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <div class="keterangan">
                        <span>Status Project</span>
                        <p id="status_project"></p>
                    </div>
                    <div class="informasi">
                        <span>informasi tugas akhir</span>
                        <ul id="data_tugas_akhir">

                        </ul>
                    </div>
                    <div class="table-container dokumen">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>BAGIAN</th>
                                    <th>NAMA FILE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody id="dataTugasAkhir">

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
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOne&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                $("#status_project").append(`<div>
                    <a class="status ${data.status == 1 ? 'status-verify' : 'status-revisi'}">
                        <i class="fa-solid ${data.status == 1 ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                            <span>${data.status == 1 ? 'Verifiy' : 'Revisi'}</span>
                            </a>
                    </div>`);
                $("#data_tugas_akhir").append(`
                    <li><span>NAMA : </span>${data.nama}</li>
                    <li><span>JUDUL : </span>${data.judul}</li>
                `);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getOne&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                $("#data").html(`<p>${data.judul}</p>`);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });

        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=tugasakhir&sub=getByTugasAkhir&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(tugas_akhir => {
                        tableContent += `
                <tr>
                <td>${tugas_akhir.bagian}</td>
                <td>${tugas_akhir.nama_file}</td>
                <td>
                <div>
                    <a class="status ${tugas_akhir.status == 1 ? 'status-verify' : 'status-revisi'}">
                        <i class="fa-solid ${tugas_akhir.status == 1 ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                            <span>${tugas_akhir.status == 1 ? 'Verifiy' : 'Revisi'}</span>
                            </a>
                    </div>
                </td>
                <td>
                    <a href="../../routes/route.php?page=tugasakhir&sub=verifikasi&id=${tugas_akhir.dokumen_id}" onclick=" return confirm('Pastikan semua catatan sudah terverifikasi !')" class="btn btn-verifikasi"><i class="fa-solid fa-circle-check"></i><span>Verifikasi</span></a>
                    <a href="../../routes/route.php?page=tugasakhir&sub=edit&id=${tugas_akhir.dokumen_id}" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i><span>Edit</span></a>
                    <a href="show_dokumen.php?id=${tugas_akhir.dokumen_id}" class="btn btn-show"><i class="fa-solid fa-eye"></i><span>Show</span></a>
                </td>
                </tr>
            `;
                    });
                    $('#dataTugasAkhir').html(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
        
    </script>