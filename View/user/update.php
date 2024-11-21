<?php
include "../component/header.php";
include "../component/sidebar.php"
?>
<div class="content">
    <div class="header-main">
        <h2>Management User</h2>
    </div>
    <div class="body-main">
    <h2>Update User</h2>
    <form action="../../routes/route.php?page=user&sub=update&id=<?= $_GET['id'] ?>" method="POST">
        <input type="number" name="username" placeholder="username" id="username">
        <input type="email" name="email" placeholder="email" id="email">
        <input type="text" name="password" placeholder="password" id="password">
        <select name="role" id="role">
            <option value="1">Super Admin</option>
            <option value="2">Mahasiswa</option>
            <option value="3">Admin Jurusan</option>
            <option value="4">Admin Prodi</option>
        </select>
        <input type="submit" value="Update">
    </form>
    </div>
</div>
<?php
include "../component/footer.php";
?>
<script>
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getOne&id=' + <?= $_GET['id'] ?>, 
        success: function(user) {
            $("#username").val(user.username);
            $("#email").val(user.email);
            $("#password").val(user.password);
            $("#role").append(`<option value="${user.role}" selected>${user.role == 1 ? "Super Admin" : (user.role == 2 ? "Mahasiswa" : (user.role == 3 ? "Admin Jurusan" : (user.role == 4 ? "Admin Prodi" : "")))}</option>`);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
</script>