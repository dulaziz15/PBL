<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
    <h1>Biodata</h1>
    <div id="buttonBiodata">
        
    </div>
    <div id="biodata">
        
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
        url: '/Pbl/routes/route.php?page=biodata&sub=getone&id= ' +<?= $_SESSION['user']['user_id'] ?>, 
        success: function(data) {
            if(data == false) {
                $("#buttonBiodata").append(`<a href="" id="btn-create-biodata">Biodata Anda belum lengkap, Lengkapi Biodata</a>`);
            } else {
                $("#biodata").append(`<h2>${data.nama}</h2>`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>