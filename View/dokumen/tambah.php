<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
        <h1>Tambah Dokumen Pendukung</h1>
        <form action="../../routes/route.php?page=dokumenpendukung&sub=addDokumen" method="post" enctype="multipart/form-data">
            <label for="tanda_terima_ta">Tanda Terima TA</label><br>
            <input type="file" name="tanda_terima_ta" id="" accept="application/pdf"><br>
            <label for="tanda_terima_pkl">Tanda Terima PKL</label><br>
            <input type="file" name="tanda_terima_pkl" id="" accept="application/pdf"><br>
            <label for="bebas_kompen">Bebas Kompen</label><br>
            <input type="file" name="bebas_kompen" id="" accept="application/pdf"><br>
            <select name="tugas_akhir" id="dataTugasAkhir">
            </select>
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
        url: '/Pbl/routes/route.php?page=tugasakhir&sub=getAll',
        success: function(data) {
            if (Array.isArray(data)) {
                    let tableContent = '';
                    data.forEach(ta => {
                        tableContent += `
                        <option value="${ta.tugas_akhir_id}:${ta.NIM}">${ta.nama + "=>" + ta.judul}</option>
                    `;
                    });
                    $('#dataTugasAkhir').append(tableContent);
                } else {
                    console.error("Expected an array but received:", data);
                }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>