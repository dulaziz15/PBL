<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <?php include_once '../component/akun.php'; ?>
    <div class="header-main">
        <h2>Management Bebas Tanggungan</h2>
    </div>
    <div class="body-main">
        <?php
        if (isset($_SESSION['sukses'])) {
            echo "<h1>" . $_SESSION['sukses'] . "</h1>";
        } elseif (isset($_SESSION['error'])) {
            echo "<h1>" . $_SESSION['error'] . "</h1>";
        }
        ?>
        <div class="card-main">
            <div class="header-card">
                <h3>Tambah Bebas Tanggungan</h3>
                <hr>
            </div>
            <div class="body-card">
                <div class="container-card">
                    <form action="../../routes/route.php?page=bebastanggungan&sub=add" method="post">
                        <select name="tugas_akhir" id="list-tugas-akhir">

                        </select>
                        <input type="submit" value="Tambah">
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
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=bebastanggungan&sub=getAllVerify',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(tugas_akhir => {
                    tableContent += `
                            <option value="${tugas_akhir.tugas_akhir_id}">${tugas_akhir.nama}</option>
                        `;
                });
                $('#list-tugas-akhir').html(tableContent);
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>