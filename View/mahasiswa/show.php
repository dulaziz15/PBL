<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management Mahasiswa</h2>
    </div>
    <div class="body-main">
    <div id="data">

    </div>
</div>
<?php
include "../component/footer.php";
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=mahasiswa&sub=show&id=<?= $_GET['id'] ?>',
        success: function(data) {
            console.log(data);
            $("#data").html(`<p>${data.nama}</p>`);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>