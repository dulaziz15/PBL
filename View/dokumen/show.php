<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Dokumen Pendukung</h2>
    </div>
    <div class="body-main">
        <a href="javascript: history.go(-1)" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        <div class="content-pdf">
            <div class="pdf dokumen_pdf pdf_tanda_terima_pkl"></div>
            <div class="pdf dokumen_pdf pdf_tanda_terima_ta"></div>
            <div class="pdf dokumen_pdf pdf_bebas_kompen"></div>
        </div>
        <div class="catatan-dokumen pendukung">
            <div class="card-catatan">
                <div class="catatan-header">
                    <span>Catatan Dokumen</span>
                    <hr>
                </div>
                <div class="tambah-catatan">
                    <a id="button-add-catatan" class="btn btn-tambah-catatan">Tambah</a>
                    <form action="../../routes/route.php?page=dokumenpendukung&sub=tambahcatatan&id=<?= $_GET['id'] ?>" method="post" style="display: none;" id="form-catatan">
                        <input type="text" placeholder="catatan" name="catatan"><br>
                        <input type="submit" value="Tambah"><br>
                    </form>
                </div>
                <div class="catatan-content">

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
    $(document).ready(function() {
        $("#button-add-catatan").click(function() {
            $("#form-catatan").slideToggle("slow");
        });
    });

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getCatatan&id=<?= $_GET['id'] ?>',
        success: function(data) {
            console.log(data);
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(catatan => {
                    tableContent += `
                        <div class="catatan-content-body">
                                    <div class="catatan-body">
                                    <div class="text">
                                        ${catatan.catatan}
                                    </div>
                                    <div class="status-catatan">
                                        <div><span>Status Catatan</span></div>
                                            <a style="margin: 10px;" class="status ${catatan.status_catatan_pendukung == 'Approved' ? 'status-verify' : catatan.status_catatan_pendukung == 'Pending' ? 'status-revisi' : 'status-submit'}">
                                                <i class="fa-solid ${catatan.status_catatan_pendukung == 'Approved' ? 'fa-circle-check' : catatan.status_catatan_pendukung == 'Pending' ? 'fa-pen-to-square' : 'fa-paper-plane'}"></i>
                                                <span>${catatan.status_catatan_pendukung == 'Approved' ? 'Verifiy' : catatan.status_catatan_pendukung == 'Pending' ? 'Revisi' : 'Pengajuan'}</span>
                                            </a>
                                        <form method="post" style="display: none;" id="form-edit-catatan-${catatan.catatan_id}">
                                            <input type="text" placeholder="catatan" name="catatan" id="edit-catatan-${catatan.catatan_id}"><br>
                                            <input type="submit" value="Update" onclick="updateCatatan(${catatan.catatan_id})"><br>
                                        </form>
                                        <div class="verifikasi-catatan">
                                            <div class="catatan-admin">
                                                <a onclick="VerifyCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <span>Verifikasi</span>
                                                </a>
                                                <a onclick="EditCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a onclick="HapusCatatan(${catatan.catatan_id})" class="btn btn-hapus" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:block;"' : ''} ">
                                                    <i class="fa-solid fa-trash"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </div>
                                            <div class="catatan-mahasiswa">
                                                <a onclick="PengajuanCatatan(${catatan.catatan_id})" class="btn btn-edit" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                                    <i class="fa-solid fa-paper-plane"></i>
                                                    <span>Pengajuan</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                });
                $('.catatan-content').append(tableContent);
                const role = <?= $_SESSION['user']['role'] ?>;
                if (role == 2) {
                    $('.catatan-admin').css('display', 'none');
                } else {
                    $('.catatan-mahasiswa').css('display', 'none');
                }
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });

    function EditCatatan(id) {
        $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getOneCatatan&id=' + id,
            success: function(data) {
                $(document).ready(function() {
                    $("#form-edit-catatan-" + id).slideToggle("slow");
                });
                $('#edit-catatan-' + data.catatan_id).val(data.catatan);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
    }

    function VerifyCatatan(id) {
        $.post("/Pbl/routes/route.php?page=dokumenpendukung&sub=verifikasiCatatan&id=" + id, {
                id: id
            },
            function(data, status) {
                window.location.reload();
            });
    }

    function updateCatatan(id) {
        $.post("/Pbl/routes/route.php?page=dokumenpendukung&sub=updateCatatan&id=" + id, {
                id: id,
                catatan: $('#edit-catatan-' + id).val()
            },
            function(data, status) {
                alert("Proses Update berhasil!");
                window.location.reload();
            });
    }

    function HapusCatatan(id) {
        $.post("/Pbl/routes/route.php?page=dokumenpendukung&sub=hapusCatatan&id=" + id, {
                id: id
            },
            function(data, status) {
                alert("Proses Hapus berhasil!");
                window.location.reload();
            });
    }

    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getOne&id=' + <?= $_GET['id'] ?>,
        success: function(data) {
            $(".pdf_tanda_terima_pkl").append(`<span>${data.tanda_terima_pkl}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.tanda_terima_pkl}" />`);
            $(".pdf_tanda_terima_ta").append(`<span>${data.tanda_terima_ta}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.tanda_terima_ta}" />`);
            $(".pdf_bebas_kompen").append(`<span>${data.bebas_kompen}</span><br><embed src="../../src/dokumen_pendukung/${data.NIM}/${data.bebas_kompen}" />`);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>