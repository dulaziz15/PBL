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
                <form action="../../routes/route.php?page=tugasakhir&sub=updateDokumenTA&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <label for="fileproject">Dokumen</label><br>
                    <input type="file" name="dokumen" id="fileproject" accept="application/pdf"><br>
                    <input type="submit" value="Update">
                </form>
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
            }
        });
    </script>