<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
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
        <div class="catatan-dokumen">
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

    function UpdateCatatan(id) {
        $.post("/Pbl/routes/route.php?page=dokumenpendukung&sub=verifikasiCatatan&id=" + id, {
                id: id,
                status: 1
            },
            function(data, status) {
                window.location.reload();
            });
    }
    

    $.ajax({
            type: 'GET',
            url: '/Pbl/routes/route.php?page=dokumenpendukung&sub=getCatatan&id=<?= $_GET['id'] ?>',
            success: function(data) {
                console.log(data);
                if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(catatan => {
                        tableContent += `
                                                <div class="catatan-body">
                                    <div class="text">
                                        ${catatan.catatan}
                                    </div>
                                    <div class="status-catatan">
                                        <div><span>Status Catatan</span></div>
                                            <a style="margin-right: 10px;" class="status ${catatan.status_catatan_pendukung == 'Approved' ? 'status-verify' : 'status-revisi'}">
                                                        <i class="fa-solid ${catatan.status_catatan_pendukung == 'Approved' ? 'fa-circle-check' : 'fa-pen-to-square'}"></i>
                                                            <span>${catatan.status_catatan_pendukung == 'Approved' ? 'Verifiy' : 'Revisi'}</span>
                                                    </a>
                                        <div class="verifikasi-catatan">
                                        <a onclick="UpdateCatatan(${catatan.catatan_id})" class="btn btn-verifikasi" ${catatan.status_catatan_pendukung == 'Approved' ? 'style="display:none;"' : ''} ">
                                            <i class="fa-solid fa-circle-check"></i>
                                            <span>Verifikasi</span>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                        `;
                    });
                    $('.card-catatan').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
            }
        });
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